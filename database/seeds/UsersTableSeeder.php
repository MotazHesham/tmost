<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'                 => 1,
                'name'               => 'Admin',
                'email'              => 'admin@admin.com',
                'password'           => bcrypt('password'),
                'remember_token'     => null,
                'verified'           => 1,
                'verified_at'        => '2021-08-09 18:47:24',
                'phone'              => '',
                'street'             => '',
                'city'               => '',
                'verification_token' => '',
            ],
        ];

        User::insert($users);
    }
}
