<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $permissions = [
            'Admin', 'Settings', 'Contact-Lists-View', 'Contact-Lists-Edit',
            'Uptime-Monitors-Edit', 'Uptime-Monitors-View', 'Status-Pages-View',
            'Status-Pages-Edit', 'Pollers-View', 'Pollers-Edit', 'Incidents-View', 'Incidents-Edit'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $adminUser = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);

        $testUser = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);


        $adminUser->givePermissionTo($permissions);


    }
}
