<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        // Insert default settings
        DB::table('settings')->insert([
            ['key' => 'site_name', 'value' => 'MediCare'],
            ['key' => 'site_logo', 'value' => null],
            ['key' => 'site_email', 'value' => 'support@medicare.com'],
            ['key' => 'site_phone', 'value' => '+1 (555) 123-4567'],
            ['key' => 'site_address', 'value' => '123 Medical Plaza, Health City, HC 45678'],
            ['key' => 'site_description', 'value' => 'Your trusted partner for all medical needs. Quality medicines delivered with care.'],
            ['key' => 'footer_text', 'value' => 'MediCare – Pharmacy Management System. All rights reserved.'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
