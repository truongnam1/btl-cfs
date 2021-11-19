<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use DebugBar\DebugBar;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;



class ManagePermissionController extends Controller
{
    public function index()
    {
        return view('admin.layout.role.permission', ['title' => 'Phân quyền']);
    }

    //api
    public function getPermissionsTable(Request $request)
    {
        $limit = (int)$request->input('length');
        $start = (int)$request->get('start');

        $colOrder = $request->get('order')[0]['column'];
        $typeOrder = $request->get('order')[0]['dir'];   // get type orderby (desc hay asc)
        $columns  = $request->get('columns');
        $colNameOrder = $columns[$colOrder]['data']; // tên cột orderby
        $searchValue = $request->get('search')['value'];


        $total = Permission::count();
        $recordsFiltered = $total;

        $data =  [];
        $permissions = '';

        if ($searchValue) {

            if ($colNameOrder == 'createdAt' && $typeOrder != null) {

                $permissions  = Permission::select('id', 'desc', 'created_at')->where('desc', 'like', "$searchValue%");
                $recordsFiltered = $permissions->count();
                $permissions = $permissions->orderBy('created_at', $typeOrder)->skip($start)->limit($limit)->with('roles')->get();
            } else {
                $permissions  = Permission::select('id', 'desc', 'created_at')->where('desc', 'like', "$searchValue%");
                $recordsFiltered = $permissions->count();
                $permissions = $permissions->skip($start)->limit($limit)->with('roles')->get();
            }
        } else {
            // nếu không có value search

            if ($colNameOrder == 'createdAt' && $typeOrder != null) {
                $permissions  = Permission::select('id', 'desc', 'created_at')
                    ->orderBy('created_at', $typeOrder)->skip($start)->limit($limit)->with('roles')->get();
            } else {
                $permissions  = Permission::select('id', 'desc', 'created_at')
                    ->skip($start)->limit($limit)->with('roles')->get();
            }
            // $permissions = Permission::select('id', 'desc', 'created_at')->skip($start)->limit($limit)->with('roles:id,desc')->get();


        }
        foreach ($permissions as $key => $permission) {
            $tempItemPer =  [
                'idPermission' => 1,
                'perAssignRole' => 'truong nam1',
                'desc' => 'admin',
                'createdAt' => '20/11/2013',
                'action' => ''
            ];
            $tempItemPer['idPermission'] = $permission->id;
            $tempItemPer['perAssignRole'] = $permission->roles;
            $tempItemPer['desc'] = $permission->desc;
            $tempItemPer['createdAt'] = $permission->created_at;

            // array_push($testData,$tempItemPer);
            array_push($data, $tempItemPer);
        }
        // $recordsFiltered = count($data);
        // $permissions = Permission::select('id', 'desc', 'created_at')->skip($start)->limit($limit)->with('roles:id,desc')->get();

        return  [
            'draw' => (int)$request->input('draw'),
            'recordsTotal' => $total,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
            'request' => $request->all(),
            // 'dataTest' => $testData,
            // 'test' => $test,
            'colOrder' => $colNameOrder,
            'searchValue' => $searchValue,
            // 'testFullText' => $permissionFullText
        ];
    }

    private function getRoleAssignPer($idPermission, $arrPerRole, $arrRole)
    {
        $arrRoleId = $arrPerRole->where('permission_id', $idPermission)->pluck('role_id');
        $arrResRoleName = $arrRole->whereIn('id', $arrRoleId)->pluck('desc', 'id');
        return $arrResRoleName;
    }

    public function updateDescPermission(Request $request, $idPermission)
    {
        $descPermission = $request->get('desc-permission');
        $permission = '';

        try {
            $permission = Permission::findOrFail($idPermission);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'error' => 'Quyền này không tồn tại',
                'request' => $request->all()
            ]);
        }

        $permission->desc = $descPermission;
        $statusUpdate = $permission->save();


        if (!$statusUpdate) {
            return response()->json([
                'status' => $statusUpdate,
                'error' => 'Lỗi không xác định',
                'request' => $request->all()
            ]);
        }
        $data = $this->getPermissionTable($idPermission, $permission)->getData()->data;

        return response()->json([
            'status' => true,
            'data' =>  $data,
            // 'request' => $request->all()
        ]);
    }

    public function getPermissionTable($permissionId, $permissionQ = null)
    {
        $permission = $permissionQ;
        if ($permission == null) {
            $permission = Permission::find($permissionId);
        }


        $tempItemPer =  [
            'idPermission' => (int)$permissionId,
            'perAssignRole' => $permission->roles()->get(['id', 'desc']),
            'desc' => $permission->desc,
            'createdAt' => $permission->created_at,
            'action' => ''
        ];
        return response()->json([
            'status' => true,
            'data' => $tempItemPer
        ]);
    }

    public function roleAssPermission($permissionId, $roles, $permissionAssRole)
    {
        $arrRole = [];
        $arrRoleId = $permissionAssRole->where('permission_id', $permissionId)->pluck('role_id');
        if (count($arrRoleId) > 0) {
            # code...
            $arrRole = $roles->whereIn('id', $arrRoleId);
        }
        return $arrRole;
    }
}
