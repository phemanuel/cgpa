<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $users = [
            [
                'last_name' => 'Akinyooye',
                'first_name' => 'Femi',
                'phone_no' => '23409073829919',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('password'),
                'user_type' => 'Superadmin',
                'user_type_status' => 1,
            ],
            [
                'last_name' => 'Markenz',
                'first_name' => 'Paul',
                'phone_no' => '23409073829919',
                'email' => 'mark@gmail.com',
                'password' => bcrypt('password'),
                'user_type' => 'Admin',
                'user_type_status' => 1,
            ],
            [
                'last_name' => 'Johnson',
                'first_name' => 'Jane',
                'phone_no' => '23408123456789',
                'email' => 'instructor@gmail.com',
                'password' => bcrypt('password'),
                'user_type' => 'Instructor',
                'user_type_status' => 3,
            ],
            [
                'last_name' => 'Doe',
                'first_name' => 'John',
                'phone_no' => '23407098765432',
                'email' => 'student@gmail.com',
                'password' => bcrypt('password'),
                'user_type' => 'Student',
                'user_type_status' => 4,
            ],
        ];
        
        DB::table('users')->insert($users);
    }
}
