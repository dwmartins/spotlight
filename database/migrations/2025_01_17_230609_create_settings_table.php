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
        Schema::create('settings', function (Blueprint $table) {
            $table->string('name', 255)->primary();
            $table->longText('value');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        $settings = [
            ['name' => 'language', 'value' => 'pt-BR'],
            ['name' => 'email_sending', 'value' => 'off'],
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

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
