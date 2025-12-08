<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    private $permissions = [
        'role-list',
        'role-create',
        'role-edit',
        'role-delete',
        'category-list',
        'category-create',
        'category-edit',
        'category-delete',
        'post-list',
        'post-create',
        'post-edit',
        'post-delete',
        'user-list',
        'user-create',
        'user-edit',
        'user-delete',
        'governorate-list',
        'governorate-create',
        'governorate-edit',
        'governorate-delete',
        'city-list',
        'city-create',
        'city-edit',
        'city-delete',
        'permission-list',
        'permission-create',
        'permission-edit',
        'permission-delete',
        'donations-list',
        'donations-delete',
    ];


    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create permissions (if they don't exist)
        foreach ($this->permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);
        $moderatorRole = Role::firstOrCreate(['name' => 'moderator']);

        // Get all permissions
        $allPermissions = Permission::all();

        // Admin gets all permissions
        $adminRole->syncPermissions($allPermissions);

        // User gets limited permissions (view only)
        $userRole->syncPermissions([
            'post-list',
            'category-list',
        ]);

        // Moderator gets moderate permissions
        $moderatorRole->syncPermissions([
            'post-list', 'post-create', 'post-edit',
            'category-list', 'category-create', 'category-edit',
            'donations-list',
        ]);

        // Note: Users are created in UserSeeder, not here
        // This keeps concerns separated
    }
}
