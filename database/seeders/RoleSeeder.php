<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      Role::create(['name' => 'employee', 'guard_name' => 'web']);
      Role::create(['name' => 'client', 'guard_name' => 'web']);
      Role::create(['name' => 'admin', 'guard_name' => 'web']);
      $employeeRole = Role::findByName('employee');
      $clientRole = Role::findByName('client');
      $adminRole = Role::findByName('admin');
      $employeeRole->givePermissionTo('manage all tickets');
      $clientRole->givePermissionTo('manage own tickets');
      $adminRole->givePermissionTo('manage users');
    }
}
