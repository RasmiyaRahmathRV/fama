<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'user_type' => 1,
            'email' => 'superadmin@demo.com',
            'username' => 'superadmin',
            'password' => bcrypt('captain')
        ]);
    }
}
