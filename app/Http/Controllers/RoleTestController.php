<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

use Faker\Factory as Faker;

class RoleTestController extends Controller
{
    public function createPer()
    {
        // $role = Role::create(['name' => 'writer']);
        $permission = Permission::create(['name' => 'edit post']);
        $permission = Permission::create(['name' => 'edit comment']);
        $permission = Permission::create(['name' => 'edit tag']);

        $permission = Permission::create(['name' => 'create post']);
        $permission = Permission::create(['name' => 'create comment']);
        $permission = Permission::create(['name' => 'create tag']);

        $permission = Permission::create(['name' => 'delete post']);
        $permission = Permission::create(['name' => 'delete comment']);
        $permission = Permission::create(['name' => 'delete tag']);



        // $role->givePermissionTo($permission);
    }

    public function createRole()
    {
        $role = Role::create(['name' => 'super-admin']);
        $role = Role::create(['name' => 'admin']);
        $role = Role::create(['name' => 'smod']);
        $role = Role::create(['name' => 'mod']);
        $role = Role::create(['name' => 'user']);
    }

    public function roleHasPer()
    {
        $arrPer = [
            'edit post',
            'edit comment',
            'edit tag',
            'create post',
            'create comment',
            'create tag',
            'delete post',
            // 'delete comment',
            // 'delete tag',
        ];
        $res = Role::findByName('mod')->givePermissionTo($arrPer);
        return $res;
    }

    public function createUser()
    {
        $faker = Faker::create();
        $arrUser = [];
        for ($i = 0; $i < 10; $i++) {
            $arr = [
                'name' => $faker->name,
                'email' => $faker->email,
                "password" => bcrypt($faker->password)
            ];

            $arrUser[] =   User::create($arr);
        }

        return $arrUser;
    }
    public function userAssignRoles()
    {
       $res = User::find('4WjNwWZX1jfk691ujw3MYXZaRfO2')->assignRole('user');
       return $res;
    }

    public function userAssPer()
    {
        $res = User::find('4WjNwWZX1jfk691ujw3MYXZaRfO2')->givePermissionTo('edit post');
       return $res;
    }
}
