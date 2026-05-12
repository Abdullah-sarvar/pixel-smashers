<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * This migration creates the password_resets table used by Laravel's
 * built-in Password Broker to store one-time reset tokens.
 *
 * If your project was created with `laravel new` you may already have
 * this table — run `php artisan migrate:status` first to check.
 *
 * Filename convention: YYYY_MM_DD_HHMMSS_create_password_resets_table.php
 */
return new class extends Migration
{
    public function up(): void
    {
        // Only create if it doesn't exist yet
        if (!Schema::hasTable('password_resets')) {
            Schema::create('password_resets', function (Blueprint $table) {
                $table->string('email')->index();   // The user's email
                $table->string('token');            // Hashed reset token
                $table->timestamp('created_at')->nullable(); // For expiry checks
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('password_resets');
    }
};