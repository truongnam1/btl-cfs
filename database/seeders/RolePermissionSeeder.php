<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Kreait\Firebase\Auth;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->runPermissions();
        $this->runRoles();

        $modRole = Role::findByName('mod');
        $userRole = Role::findByName('user');

        $modRole->givePermissionTo('posts.*');
        $modRole->givePermissionTo('posts.edit');
        $modRole->givePermissionTo('posts.read');

        $modRole->givePermissionTo('comments.edit');
        $modRole->givePermissionTo('comments.read');
        $modRole->givePermissionTo('comments.create');

        $userRole->givePermissionTo('posts.*');
        $userRole->givePermissionTo('posts.edit');
        $userRole->givePermissionTo('posts.read');
        $userRole->givePermissionTo('posts.create');

        User::all()->first()->assignRole('mod');
        User::all()->first()->assignRole('user');

        $users = User::all();
        foreach ($users as  $user) {
            $user->assignRole('user');
        }

        $userProperties = [
            'email' => 'namtao100@gmail.com',
            'emailVerified' => false,
            'password' => '123456',
            'displayName' => 'truong nam',
            'photoUrl' => 'https://hinhnen123.com/wp-content/uploads/2021/06/avt-cute-9.jpg',
            'disabled' => false,
        ];
        $createdUser = $this->auth->createUser($userProperties);

        $user = User::create([
            'id' => $createdUser->uid,
            'name' => $createdUser->displayName,
            'isActive' => !$createdUser->disabled,
            'register_at' => $createdUser->metadata->createdAt,
        ]);

        $user->assignRole('user');
        $user->assignRole('mod');
        $user->assignRole('super-admin');

    }


    private function runPermissions()
    {
        $teamId = 1;

        //posts
        $team_name = 'b??i vi???t';
        Permission::create(['name' => 'posts.*', 'desc' => 'b??i vi???t', 'team_permission_id' => $teamId, 'action' => 't???t c???', 'team_name' => $team_name]);
        Permission::create(['name' => 'posts.edit', 'desc' => 's???a b??i vi???t', 'team_permission_id' => $teamId, 'action' => 's???a', 'team_name' => $team_name]);
        Permission::create(['name' => 'posts.read', 'desc' => 'xem b??i vi???t', 'team_permission_id' => $teamId, 'action' => 'xem', 'team_name' => $team_name]);
        Permission::create(['name' => 'posts.create', 'desc' => 't???o b??i vi???t', 'team_permission_id' => $teamId, 'action' => 't???o', 'team_name' => $team_name]);
        $teamId++;

        //comments
        $team_name = 'b??nh lu???n';
        Permission::create(['name' => 'comments.*', 'desc' => 'b??nh lu???n', 'team_permission_id' => $teamId, 'action' => 't???t c???', 'team_name' => $team_name]);
        Permission::create(['name' => 'comments.edit', 'desc' => 's???a b??nh lu???n', 'team_permission_id' => $teamId, 'action' => 's???a', 'team_name' => $team_name]);
        Permission::create(['name' => 'comments.read', 'desc' => 'xem b??nh lu???n', 'team_permission_id' => $teamId, 'action' => 'xem', 'team_name' => $team_name]);
        Permission::create(['name' => 'comments.create', 'desc' => 't???o b??nh lu???n', 'team_permission_id' => $teamId, 'action' => 't???o', 'team_name' => $team_name]);
        $teamId++;


        //manage user
        $team_name = 'qu???n l?? ng?????i d??ng';
        Permission::create(['name' => 'manage.user.*', 'desc' => 'qu???n l?? ng?????i d??ng', 'team_permission_id' => $teamId, 'action' => 't???t c???', 'team_name' => $team_name]);
        Permission::create(['name' => 'manage.user.disable-user', 'desc' => 'qu???n l?? ng?????i d??ng', 'team_permission_id' => $teamId, 'action' => 'kho??', 'team_name' => $team_name]);
        Permission::create(['name' => 'manage.user.active-user', 'desc' => 'qu???n l?? ng?????i d??ng', 'team_permission_id' => $teamId, 'action' => 'k??ch ho???t', 'team_name' => $team_name]);
        Permission::create(['name' => 'manage.user.change-password', 'desc' => 'qu???n l?? ng?????i d??ng', 'team_permission_id' => $teamId, 'action' => '?????i m???t kh???u', 'team_name' => $team_name]);
        Permission::create(['name' => 'manage.user.view-profile', 'desc' => 'qu???n l?? ng?????i d??ng', 'team_permission_id' => $teamId, 'action' => 'xem th??ng tin', 'team_name' => $team_name]);
        Permission::create(['name' => 'manage.user.view-manage', 'desc' => 'qu???n l?? ng?????i d??ng', 'team_permission_id' => $teamId, 'action' => 'xem', 'team_name' => $team_name]);
        $teamId++;


        //manage tag
        $team_name = 'qu???n l?? nh??n';
        Permission::create(['name' => 'manage.tag.*', 'desc' => 'qu???n l?? nh??n', 'team_permission_id' => $teamId, 'action' => 't???t c???', 'team_name' => $team_name]);
        Permission::create(['name' => 'manage.tag.view-manage', 'desc' => 'xem danh s??ch nh??n', 'team_permission_id' => $teamId, 'action' => 'xem', 'team_name' => $team_name]);
        Permission::create(['name' => 'manage.tag.edit', 'desc' => 'ch???nh s???a nh??n', 'team_permission_id' => $teamId, 'action' => 's???a', 'team_name' => $team_name]);
        Permission::create(['name' => 'manage.tag.delete', 'desc' => 'xo?? nh??n', 'team_permission_id' => $teamId, 'action' => 'xo??', 'team_name' => $team_name]);
        $teamId++;

        //manage report post
        $team_name = 'qu???n l?? b??o c??o b??i vi???t';
        Permission::create(['name' => 'manage.posts-report.*', 'desc' => 'qu???n l?? b??o c??o b??i vi???t', 'team_permission_id' => $teamId, 'action' => 't???t c???', 'team_name' => $team_name]);
        Permission::create(['name' => 'manage.posts-report.view-manage', 'desc' => 'xem danh s??ch b??o c??o', 'team_permission_id' => $teamId, 'action' => 'xem', 'team_name' => $team_name]);
        Permission::create(['name' => 'manage.posts-report.edit', 'desc' => 'ch???nh s???a b??o c??o', 'team_permission_id' => $teamId, 'action' => 's???a', 'team_name' => $team_name]);
        $teamId++;

        //manage role
        $team_name = 'qu???n l?? vai tr??';
        Permission::create(['name' => 'manage.role.*', 'desc' => 'qu???n l?? vai tr??', 'team_permission_id' => $teamId, 'action' => 't???t c???', 'team_name' => $team_name]);
        Permission::create(['name' => 'manage.role.view-manage', 'desc' => 'xem danh s??ch vai tr??', 'team_permission_id' => $teamId, 'action' => 'xem', 'team_name' => $team_name]);
        Permission::create(['name' => 'manage.role.edit', 'desc' => 'ch???nh s???a vai tr??', 'team_permission_id' => $teamId, 'action' => 's???a', 'team_name' => $team_name]);
        Permission::create(['name' => 'manage.role.create', 'desc' => 't???o m???i vai tr??', 'team_permission_id' => $teamId, 'action' => 't???o', 'team_name' => $team_name]);
        Permission::create(['name' => 'manage.role.delete', 'desc' => 'xo?? vai tr??', 'team_permission_id' => $teamId, 'action' => 'xo??', 'team_name' => $team_name]);
        $teamId++;

        //manage permission
        $team_name = 'qu???n l?? quy???n';
        Permission::create(['name' => 'manage.permission.view-manage', 'desc' => 'qu???n l?? quy???n', 'team_permission_id' => $teamId, 'action' => 'xem', 'team_name' => $team_name]);
        Permission::create(['name' => 'manage.permission.edit', 'desc' => 'ch???nh s???a quy???n', 'team_permission_id' => $teamId, 'action' => 's???a', 'team_name' => $team_name]);
    }

    private function runRoles()
    {
        $role = Role::create(['name' => 'super-admin', 'desc' => 'Si??u qu???n tr???']);
        $role = Role::create(['name' => 'mod', 'desc' => 'Ng?????i ki???m duy???t']);
        $role = Role::create(['name' => 'user', 'desc' => 'Ng?????i d??ng']);
        $role = Role::create(['name' => 'anonymous', 'desc' => 'Ng?????i ch??a c?? t??i kho???n']);
    }
}
