<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AccessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role2 = Role::find(2);
        $role2->syncPermissions(['roles.index','roles.create','roles.edit','roles.show']);
        $role3 = Role::find(3);
        $role3->syncPermissions(['permissions.index','permissions.create','permissions.edit','permissions.show']);
        $role4 = Role::find(4);
        $role4->syncPermissions(['users.index','users.create','users.edit','users.show','users.roles.edit','users.permissions.edit' ]);
        $role5 = Role::find(5);
        $role5->syncPermissions(['clients.index','clients.create','clients.edit','clients.show']);
        $role6 = Role::find(6);
        $role6->syncPermissions(['roles.index','roles.edit','permissions.index','permissions.edit','users.index','users.edit','users.roles.edit','users.permissions.edit', 'users.owner.all','clients.index','clients.edit']);

    }
}
