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
        Role::create(['name' => 'Super Admin']);
        Role::create(['name' => 'Gerenciar Papéis']);
        Role::create(['name' => 'Gerenciar Permissões']);
        Role::create(['name' => 'Gerenciar Usuários']);
        Role::create(['name' => 'Gerenciar Clientes']);
        Role::create(['name' => 'Editor']);
    }
}
