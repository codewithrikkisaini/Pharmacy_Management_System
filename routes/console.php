<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/run-migration-manually', function () {
    try {
        Artisan::call('migrate', ['--force' => true]);
        return 'Migration successful: ' . Artisan::output();
    } catch (\Exception $e) {
        return 'Migration failed: ' . $e->getMessage();
    }
});
