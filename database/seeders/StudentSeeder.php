<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Student;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan role siswa sudah ada
        $roleSiswa = Role::where('name', 'siswa')->first();

        if (!$roleSiswa) {
            $this->command->error("Role 'siswa' tidak ditemukan. Pastikan RoleSeeder sudah dijalankan.");
            return;
        }

        $siswaData = [
            ['name' => 'Agni ahmad Saripudn', 'email' => 'agni@example.com', 'nis' => '2324001'],
            ['name' => 'Muhammad rizal', 'email' => 'rizal@example.com', 'nis' => '2324002'],
            ['name' => 'Ronss', 'email' => 'ronss@example.com', 'nis' => '2324003'],
            ['name' => 'Fajar', 'email' => 'fajar@example.com', 'nis' => '2324004'],
            ['name' => 'Zaki', 'email' => 'zaki@example.com', 'nis' => '2324005'],
            ['name' => 'Ahmad', 'email' => 'ahmad@example.com', 'nis' => '2324006'],
        ];

        foreach ($siswaData as $data) {
            // 1. Buat User baru
            $user = User::create([
                'name'     => $data['name'],
                'email'    => $data['email'],
                'password' => Hash::make('password123'),
                'role_id'  => $roleSiswa->id, // Menghubungkan ke role siswa
            ]);

            // 2. Buat data Student yang terhubung ke User tersebut
            Student::create([
                'user_id' => $user->id, // FK ke tabel users
                'nis'     => $data['nis'],
                'kelas'   => 'XII-RPL',
            ]);
        }

        $this->command->info("Berhasil menambahkan 7 data siswa.");
    }
}