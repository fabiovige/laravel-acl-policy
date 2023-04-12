<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                //Admin Seeder
                $user = User::create([
                    'name' => 'Fabio Vige',
                    'email' => 'admin@fabiovige.com.br',
                    'password' => bcrypt('password')
                ]);

                $role = Role::create(['name' => 'Admin']);

                $permissions = Permission::pluck('id','id')->all();

                $role->syncPermissions($permissions);

                $user->assignRole([$role->id]);
    }
}
