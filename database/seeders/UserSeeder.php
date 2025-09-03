<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan role sudah ada
        Role::firstOrCreate(['name' => 'igd']);
        Role::firstOrCreate(['name' => 'rawat_inap']);

        // Buat user IGD
        $igd = User::create([
            'name' => 'Admin IGD',
            'email' => 'admin@igd.test',
            'password' => Hash::make('password'),
        ]);
        $igd->assignRole('igd');

        // Buat user Rawat Inap
        $ri = User::create([
            'name' => 'Admin Rawat Inap',
            'email' => 'admin@rawat.test',
            'password' => Hash::make('password'),
        ]);
        $ri->assignRole('rawat_inap');
    }
}