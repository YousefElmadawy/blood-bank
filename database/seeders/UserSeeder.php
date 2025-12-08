<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Roles are already created by PermissionTableSeeder
        // But we ensure they exist here too (safe with firstOrCreate)
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Create or update admin user
        $admin = User::updateOrCreate(
            ['email' => 'admin@bloodbank.com'],
            [
                'name'     => 'Admin User',
                'password' => Hash::make('password'),
            ]
        );

        // Ensure admin has admin role
        if (!$admin->hasRole('admin')) {
            $admin->assignRole('admin');
        }

        // Create or update regular user
        $user = User::updateOrCreate(
            ['email' => 'user@bloodbank.com'],
            [
                'name'     => 'Test User',
                'password' => Hash::make('password'),
            ]
        );

        // Ensure user has user role
        if (!$user->hasRole('user')) {
            $user->assignRole('user');
        }

        $this->command->info('✓ Users created/updated successfully');
        $this->command->info("  - Admin: admin@bloodbank.com / password (roles: {$admin->getRoleNames()->join(', ')})");
        $this->command->info("  - User: user@bloodbank.com / password (roles: {$user->getRoleNames()->join(', ')})");
    }
}
