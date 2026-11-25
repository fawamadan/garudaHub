<?php

namespace Database\Seeders;

use App\Models\Bid;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Client & Freelancer
        $client = User::create([
            'name' => 'Budi Santoso',
            'email' => 'client@garudahub.test',
            'password' => Hash::make('password'),
            'role' => 'client',
        ]);

        $freelancer1 = User::create([
            'name' => 'Danu Fawaid',
            'email' => 'danu@garudahub.test',
            'password' => Hash::make('password'),
            'role' => 'freelancer',
        ]);

        $freelancer2 = User::create([
            'name' => 'Siti Aminah',
            'email' => 'siti@garudahub.test',
            'password' => Hash::make('password'),
            'role' => 'freelancer',
        ]);

        // 2. Data Proyek
        $project1 = Project::create([
            'client_id' => $client->id,
            'title' => 'Pengembangan Sistem Kasir UMKM Berbasis Web',
            'description' => 'Membutuhkan aplikasi kasir sederhana dengan laporan penjualan harian dan manajemen stok barang.',
            'budget' => 3500000,
            'deadline' => now()->addDays(21)->toDateString(),
            'status' => 'open',
        ]);

        $project2 = Project::create([
            'client_id' => $client->id,
            'title' => 'Redesign Landing Page & Identitas Visual Startup',
            'description' => 'Desain ulang halaman utama responsif beserta panduan warna dan tipografi modern.',
            'budget' => 2000000,
            'deadline' => now()->addDays(14)->toDateString(),
            'status' => 'open',
        ]);

        // 3. Data Penawaran (Bids)
        Bid::create([
            'project_id' => $project1->id,
            'freelancer_id' => $freelancer1->id,
            'offered_price' => 3200000,
            'estimated_days' => 14,
            'proposal' => 'Siap mengerjakan menggunakan Laravel dengan fitur cetak struk dan ekspor laporan otomatis.',
            'status' => 'pending',
        ]);

        Bid::create([
            'project_id' => $project1->id,
            'freelancer_id' => $freelancer2->id,
            'offered_price' => 3400000,
            'estimated_days' => 18,
            'proposal' => 'Berpengalaman membuat aplikasi inventori dan POS dengan antarmuka ramah pengguna.',
            'status' => 'pending',
        ]);

        Bid::create([
            'project_id' => $project2->id,
            'freelancer_id' => $freelancer1->id,
            'offered_price' => 1850000,
            'estimated_days' => 10,
            'proposal' => 'Menyertakan prototipe interaktif di Figma dan implementasi kode bersih siap pakai.',
            'status' => 'pending',
        ]);
    }
}
