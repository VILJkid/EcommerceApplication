<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserRole;

class CreateUserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserRole::create([
            'role_name'=>'Super Admin'
        ]);
        UserRole::create([
            'role_name'=>'Admin'
        ]);
        UserRole::create([
            'role_name'=>'Inventory Manager'
        ]);
        UserRole::create([
            'role_name'=>'Order Manager'
        ]);
        UserRole::create([
            'role_name'=>'Customer'
        ]);
    }
}
