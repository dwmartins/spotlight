<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['name' => 'language', 'value' => 'pt-BR'],
            ['name' => 'timezone', 'value' => 'America/Sao_Paulo'],
            ['name' => 'date_format', 'value' => 'DD-MM-YYYY'],
            ['name' => 'clock_type', 'value' => 24],
            ['name' => 'compress_image', 'value' => 'off'],
            ['name' => 'maintenance', 'value' => 'off'],
            ['name' => 'min_password_length', 'value' => 6]
        ];

        foreach ($settings as $setting) {
            DB::table('settings')->insert($setting);
        }
    }
}
