<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Permissions
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-show',
            'role-delete',
            'user-list',
            'user-list-any',
            'user-create',
            'user-edit',
            'user-show',
            'user-delete',
            'client-list',
            'client-list-any',
            'client-create',
            'client-edit',
            'client-show',
            'client-delete'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
