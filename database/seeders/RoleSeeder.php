<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Buat Role
        $adminIgd = Role::firstOrCreate(['name' => 'admin igd']);
        $adminRawat = Role::firstOrCreate(['name' => 'admin rawat inap']);

        // Buat Permissions
        $permIgd = Permission::firstOrCreate(['name' => 'lihat igd']);
        $permRawat = Permission::firstOrCreate(['name' => 'lihat rawat inap']);

        // Assign Permissions ke Role
        $adminIgd->givePermissionTo($permIgd);
        $adminRawat->givePermissionTo($permRawat);
    }
}