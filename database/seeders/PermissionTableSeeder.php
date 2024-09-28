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
        foreach ($this->permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create admin User and assign the role to him.
        $user = User::create([
            'name' => 'yousef77',
            'email' => 'yousef77@admin.com',
            'password' => Hash::make('123456789')
        ]);

        $role = Role::create(['name' => 'Admin']);

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
