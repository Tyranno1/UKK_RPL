<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run()
    {
        $kategoris = [
            'Kerusakan Fasilitas KBM',
            'Kerusakan Jaringan dan Internet',
            'Lainnya',
        ];

        foreach ($kategoris as $nama) {
            Kategori::create([
                'nama_kategori' => $nama,
                'deskripsi'     => '-'
                ]);
        }
    }
}