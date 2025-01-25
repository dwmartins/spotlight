<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('website_colors', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('hex_value', 20);
            $table->timestamps();
        });

        $colors = [
            ['name' => 'primary', 'hex_value' => '#409EFF'],
            ['name' => 'success', 'hex_value' => '#67C23A'],
            ['name' => 'warning', 'hex_value' => '#FFC107'],
            ['name' => 'danger', 'hex_value' => '#DC3545'],
        ];

        foreach ($colors as $color) {
            DB::table('website_colors')->insert($color);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_colors');
    }
};
