<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'role_id' => 1,
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'),
            'status' => 1,
            'email_status' => 1
        ]);

        User::create([
            'role_id' => 2,
            'first_name' => 'Gurpreet',
            'last_name' => 'Singh',
            'email' => 'gurpreet@yopmail.com',
            'password' => Hash::make('123456789'),
            'status' => 1,
            'email_status' => 1
        ]);
    }
}
