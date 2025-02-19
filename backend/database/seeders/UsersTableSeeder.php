<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Tạo tài khoản admin chung
        User::create([
            'name' => 'TechShop',
            'email' => 'techshop014@gmail.com',
            'password' => Hash::make('techshop123'),
            'role' => 'admin',
            'address' => '',
            'phone' => '',
        ]);
    }
}
