<?php

namespace Database\Seeders;

use App\Models\SettingMagang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingMagangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SettingMagang::create([
            'magang_batch' => 'Batch 1',
            'tanggal_mulai' => '2024-06-01',
            'tanggal_selesai' => '2024-08-31',
        ]);

        SettingMagang::create([
            'magang_batch' => 'Batch 2',
            'tanggal_mulai' => '2024-09-01',
            'tanggal_selesai' => '2024-11-30',
        ]);
    }
}
