<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Role;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $admin = Role::where('name','admin')->first();
        $guru  = Role::where('name','guru')->first();
        $siswa = Role::where('name','siswa')->first();

        User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'),
            'role_id' => $admin->id
        ]);

        User::create([
            'name' => 'Guru',
            'email' => 'guru@test.com',
            'password' => Hash::make('password'),
            'role_id' => $guru->id
        ]);

        User::create([
            'name' => 'Siswa',
            'email' => 'siswa@test.com',
            'password' => Hash::make('password'),
            'role_id' => $siswa->id
        ]);
    }

}
