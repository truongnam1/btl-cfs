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
        $team_name = 'bài viết';
        Permission::create(['name' => 'posts.*', 'desc' => 'bài viết', 'team_permission_id' => $teamId, 'action' => 'tất cả', 'team_name' => $team_name]);
        Permission::create(['name' => 'posts.edit', 'desc' => 'sửa bài viết', 'team_permission_id' => $teamId, 'action' => 'sửa', 'team_name' => $team_name]);
        Permission::create(['name' => 'posts.read', 'desc' => 'xem bài viết', 'team_permission_id' => $teamId, 'action' => 'xem', 'team_name' => $team_name]);
        Permission::create(['name' => 'posts.create', 'desc' => 'tạo bài viết', 'team_permission_id' => $teamId, 'action' => 'tạo', 'team_name' => $team_name]);
        $teamId++;

        //comments
        $team_name = 'bình luận';
        Permission::create(['name' => 'comments.*', 'desc' => 'bình luận', 'team_permission_id' => $teamId, 'action' => 'tất cả', 'team_name' => $team_name]);
        Permission::create(['name' => 'comments.edit', 'desc' => 'sửa bình luận', 'team_permission_id' => $teamId, 'action' => 'sửa', 'team_name' => $team_name]);
        Permission::create(['name' => 'comments.read', 'desc' => 'xem bình luận', 'team_permission_id' => $teamId, 'action' => 'xem', 'team_name' => $team_name]);
        Permission::create(['name' => 'comments.create', 'desc' => 'tạo bình luận', 'team_permission_id' => $teamId, 'action' => 'tạo', 'team_name' => $team_name]);
        $teamId++;


        //manage user
        $team_name = 'quản lý người dùng';
        Permission::create(['name' => 'manage.user.*', 'desc' => 'quản lý người dùng', 'team_permission_id' => $teamId, 'action' => 'tất cả', 'team_name' => $team_name]);
        Permission::create(['name' => 'manage.user.disable-user', 'desc' => 'quản lý người dùng', 'team_permission_id' => $teamId, 'action' => 'khoá', 'team_name' => $team_name]);
        Permission::create(['name' => 'manage.user.active-user', 'desc' => 'quản lý người dùng', 'team_permission_id' => $teamId, 'action' => 'kích hoạt', 'team_name' => $team_name]);
        Permission::create(['name' => 'manage.user.change-password', 'desc' => 'quản lý người dùng', 'team_permission_id' => $teamId, 'action' => 'đổi mật khẩu', 'team_name' => $team_name]);
        Permission::create(['name' => 'manage.user.view-profile', 'desc' => 'quản lý người dùng', 'team_permission_id' => $teamId, 'action' => 'xem thông tin', 'team_name' => $team_name]);
        Permission::create(['name' => 'manage.user.view-manage', 'desc' => 'quản lý người dùng', 'team_permission_id' => $teamId, 'action' => 'xem', 'team_name' => $team_name]);
        $teamId++;


        //manage tag
        $team_name = 'quản lý nhãn';
        Permission::create(['name' => 'manage.tag.*', 'desc' => 'quản lý nhãn', 'team_permission_id' => $teamId, 'action' => 'tất cả', 'team_name' => $team_name]);
        Permission::create(['name' => 'manage.tag.view-manage', 'desc' => 'xem danh sách nhãn', 'team_permission_id' => $teamId, 'action' => 'xem', 'team_name' => $team_name]);
        Permission::create(['name' => 'manage.tag.edit', 'desc' => 'chỉnh sửa nhãn', 'team_permission_id' => $teamId, 'action' => 'sửa', 'team_name' => $team_name]);
        Permission::create(['name' => 'manage.tag.delete', 'desc' => 'xoá nhãn', 'team_permission_id' => $teamId, 'action' => 'xoá', 'team_name' => $team_name]);
        $teamId++;

        //manage report post
        $team_name = 'quản lý báo cáo bài viết';
        Permission::create(['name' => 'manage.posts-report.*', 'desc' => 'quản lý báo cáo bài viết', 'team_permission_id' => $teamId, 'action' => 'tất cả', 'team_name' => $team_name]);
        Permission::create(['name' => 'manage.posts-report.view-manage', 'desc' => 'xem danh sách báo cáo', 'team_permission_id' => $teamId, 'action' => 'xem', 'team_name' => $team_name]);
        Permission::create(['name' => 'manage.posts-report.edit', 'desc' => 'chỉnh sửa báo cáo', 'team_permission_id' => $teamId, 'action' => 'sửa', 'team_name' => $team_name]);
        $teamId++;

        //manage role
        $team_name = 'quản lý vai trò';
        Permission::create(['name' => 'manage.role.*', 'desc' => 'quản lý vai trò', 'team_permission_id' => $teamId, 'action' => 'tất cả', 'team_name' => $team_name]);
        Permission::create(['name' => 'manage.role.view-manage', 'desc' => 'xem danh sách vai trò', 'team_permission_id' => $teamId, 'action' => 'xem', 'team_name' => $team_name]);
        Permission::create(['name' => 'manage.role.edit', 'desc' => 'chỉnh sửa vai trò', 'team_permission_id' => $teamId, 'action' => 'sửa', 'team_name' => $team_name]);
        Permission::create(['name' => 'manage.role.create', 'desc' => 'tạo mới vai trò', 'team_permission_id' => $teamId, 'action' => 'tạo', 'team_name' => $team_name]);
        Permission::create(['name' => 'manage.role.delete', 'desc' => 'xoá vai trò', 'team_permission_id' => $teamId, 'action' => 'xoá', 'team_name' => $team_name]);
        $teamId++;

        //manage permission
        $team_name = 'quản lý quyền';
        Permission::create(['name' => 'manage.permission.view-manage', 'desc' => 'quản lý quyền', 'team_permission_id' => $teamId, 'action' => 'xem', 'team_name' => $team_name]);
        Permission::create(['name' => 'manage.permission.edit', 'desc' => 'chỉnh sửa quyền', 'team_permission_id' => $teamId, 'action' => 'sửa', 'team_name' => $team_name]);
    }

    private function runRoles()
    {
        $role = Role::create(['name' => 'super-admin', 'desc' => 'Siêu quản trị']);
        $role = Role::create(['name' => 'mod', 'desc' => 'Người kiểm duyệt']);
        $role = Role::create(['name' => 'user', 'desc' => 'Người dùng']);
        $role = Role::create(['name' => 'anonymous', 'desc' => 'Người chưa có tài khoản']);
    }
}
