<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        try {
            // Self-healing database structure
            if (!\Illuminate\Support\Facades\Schema::hasTable('contact_messages')) {
                \Illuminate\Support\Facades\DB::statement("CREATE TABLE contact_messages (id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, message TEXT NOT NULL, is_read BOOLEAN DEFAULT FALSE, created_at TIMESTAMP NULL, updated_at TIMESTAMP NULL)");
            }
            if (!\Illuminate\Support\Facades\Schema::hasTable('settings')) {
                \Illuminate\Support\Facades\DB::statement("CREATE TABLE settings (id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY, `key` VARCHAR(255) UNIQUE, value TEXT, created_at TIMESTAMP NULL, updated_at TIMESTAMP NULL)");
            }
            if (!\Illuminate\Support\Facades\Schema::hasTable('banners')) {
                \Illuminate\Support\Facades\DB::statement("CREATE TABLE banners (id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY, title VARCHAR(255), subtitle VARCHAR(255), image VARCHAR(255), link VARCHAR(255), status BOOLEAN DEFAULT TRUE, `order` INTEGER DEFAULT 0, created_at TIMESTAMP NULL, updated_at TIMESTAMP NULL)");
            }
            if (!\Illuminate\Support\Facades\Schema::hasTable('blogs')) {
                \Illuminate\Support\Facades\DB::statement("CREATE TABLE blogs (id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY, title VARCHAR(255), slug VARCHAR(255) UNIQUE, content TEXT, image VARCHAR(255), status BOOLEAN DEFAULT TRUE, user_id BIGINT UNSIGNED, created_at TIMESTAMP NULL, updated_at TIMESTAMP NULL)");
            }

            // Share settings globally
            if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
                $settings = \App\Models\Setting::pluck('value', 'key')->toArray();
                view()->share('site_settings', (object) $settings);
            }
        } catch (\Exception $e) {
            // Silence error
        }
    }
}
