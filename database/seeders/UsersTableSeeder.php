<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Mahasiswa User',
                'email' => 'mahasiswa@example.com',
                'password' => Hash::make('password'), // Password harus di-hash
                'role_id' => 1,
            ],
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'), // Password harus di-hash
                'role_id' => 2,
            ],
            [
                'name' => 'Mitra User',
                'email' => 'mitra@example.com',
                'password' => Hash::make('password'), // Password harus di-hash
                'role_id' => 3,
            ],
            [
                'name' => 'Dosen User',
                'email' => 'dosen@example.com',
                'password' => Hash::make('password'), // Password harus di-hash
                'role_id' => 4,
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
