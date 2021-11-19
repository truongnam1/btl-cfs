<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Kreait\Firebase\Auth;
use App\Models\User;


class UsersSeeder extends Seeder
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
        $this->deleteAllUserFirebase();
        $number = 5;
        $arrUser = [];
        $faker = Faker::create();
        for ($i = 0; $i < $number; $i++) {
            $userProperties = [
                'email' => $faker->email,
                'emailVerified' => false,
                'phoneNumber' => $faker->e164PhoneNumber,
                'password' => '123456',
                'displayName' => $faker->name,
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

            // $arrUser[] = $createdUser;
        }
       
    }


    private function deleteAllUserFirebase()
    {
        $users = $this->auth->listUsers();
        $arrUid = [];

        foreach ($users as $user) {
            array_push($arrUid, $user->uid);
        }
        if (count($arrUid) >= 1) {
            $forceDeleteEnabledUsers = true; // default: false
            $result = $this->auth->deleteUsers($arrUid, $forceDeleteEnabledUsers);
        }
    }
}
