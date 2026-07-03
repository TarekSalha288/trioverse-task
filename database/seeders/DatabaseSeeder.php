<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
        ]);
        $admin=User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);
        $admin->assignRole('admin');
         $employee = User::factory()->create([
            'name' => 'Support Agent',
            'email' => 'agent@support.com',
            'password' => bcrypt('password'),
        ]);
        $employee->assignRole('employee');
        $client = User::factory()->create([
            'name' => 'Tareq Salha',
            'email' => 'tareq@client.com',
            'password' => bcrypt('password'),
        ]);
        $client->assignRole('client');

    }
}
