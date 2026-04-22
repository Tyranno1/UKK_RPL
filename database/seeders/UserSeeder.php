<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name'     => 'Cikgu Besar',
            'email'    => 'admin@example.com',
            'nis_nip'  => '0987654321',
            'kelas'    => '-',
            'telp'     => '08123456789',
            'password' => Hash::make('password123'),
            'level'    => 'admin',
        ]);

        User::create([
            'name'     => 'John Sawito',
            'email'    => 'john.sawito@example.com',
            'nis_nip'  => '1234567890',
            'kelas'    => 'XII RPL 3',
            'telp'     => '08987654321',
            'password' => Hash::make('password123'),
            'level'    => 'siswa',
        ]);
    }
}
