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
        $kepalaSekolah = Role::where('name', 'Kepala Sekolah')->first();
        $tu = Role::where('name','tu')->first();
        $guru  = Role::where('name','guru')->first();
        $siswa = Role::where('name','siswa')->first();

        User::create([
            'name' => 'Kepala Sekolah',
            'email' => 'kepalaSekolah@test.com',
            'password' => Hash::make('password'),
            'role_id' => $kepalaSekolah->id
        ]);

        User::create([
            'name' => 'Tu',
            'email' => 'tu@test.com',
            'password' => Hash::make('password'),
            'role_id' => $tu->id
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
