<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WebsiteColorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            ['name' => 'primary', 'hex_value' => '#409EFF'],
            ['name' => 'success', 'hex_value' => '#67C23A'],
            ['name' => 'warning', 'hex_value' => '#FFC107'],
            ['name' => 'danger', 'hex_value' => '#DC3545'],
            
            ['name' => 'link_color', 'hex_value' => '#409EFF'],
        ];

        foreach ($colors as $color) {
            DB::table('website_colors')->insert($color);
        }
    }
}
