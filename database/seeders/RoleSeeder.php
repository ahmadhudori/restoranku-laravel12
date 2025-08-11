<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
			['role_name' => 'Admin', 'description' => 'Administrator with full access'],
			['role_name' => 'Chasier', 'description' => 'Cashier with limited access'],
			['role_name' => 'Chef', 'description' => 'Chef with access to kitchen features'],
			['role_name' => 'Customer', 'description' => 'Registered customer with access to personal features'],
		];

		DB::table('roles')->insert($roles);
    }
}
