<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Permissions
        $permissions = [
            'roles.index',
            'roles.create',
            'roles.edit',
            'roles.show',
            'roles.destroy',
            'permissions.index',
            'permissions.create',
            'permissions.edit',
            'permissions.show',
            'permissions.destroy',
            'users.index',
            'users.create',
            'users.edit',
            'users.show',
            'users.destroy',
            'users.roles.edit',
            'users.permissions.edit',
            'clients.index',
            'clients.create',
            'clients.edit',
            'clients.show',
            'clients.destroy'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
