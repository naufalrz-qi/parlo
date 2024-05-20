<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'username'     => 'admin',
                'name'     => 'admin',
                'email'    => 'admin@gmail.com',
                'password'     => Hash::make('admin'),
                'role'          => 'admin',
                'phone_number' =>  '082340922344',
            ],
            [
                'username'     => 'user1',
                'name'     => 'User Dummy',
                'email'    => 'user1@gmail.com',
                'password'     => Hash::make('user1'),
                'role'          => 'user',
                'phone_number' =>  '085763942394',
            ],
            [
                'username'     => 'employee1',
                'name'     => 'Employee Dummy',
                'email'    => 'employee1@gmail.com',
                'password'     => Hash::make('employee1'),
                'role'          => 'employee',
                'phone_number' =>  '085763942391',

            ]
        ]);
    }
}
