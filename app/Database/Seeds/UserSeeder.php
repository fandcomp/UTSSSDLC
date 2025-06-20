<?php
// File: app/Database/Seeds/UserSeeder.php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Nonaktifkan foreign key check untuk sementara
        $this->db->disableForeignKeyChecks();

        // Kosongkan tabel quiz_results terlebih dahulu
        $this->db->table('quiz_results')->truncate();
        // Kosongkan tabel users
        $this->db->table('users')->truncate();

        // Aktifkan kembali foreign key check
        $this->db->enableForeignKeyChecks();

        // Data pengguna baru
        $data = [
            [
                'username' => 'alice', // Peran 'user'
                'password' => password_hash('user123', PASSWORD_DEFAULT),
                'role'     => 'user'
            ],
            [
                'username' => 'admin', // Peran 'admin'
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'role'     => 'admin' // Disesuaikan agar cocok dengan ENUM di database
            ],
        ];

        // Masukkan data baru
        $this->db->table('users')->insertBatch($data);
    }
}