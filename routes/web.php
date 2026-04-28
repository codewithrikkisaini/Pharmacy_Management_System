<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Home;
use App\Livewire\Medicines;
use App\Livewire\Doctors;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\Categories as AdminCategories;
use App\Livewire\Admin\Medicines as AdminMedicines;
use App\Livewire\Admin\Doctors as AdminDoctors;

// Frontend Routes
Route::get('/', Home::class)->name('home');
Route::get('/medicines', Medicines::class)->name('medicines');
Route::get('/doctors', Doctors::class)->name('doctors');

// Authenticated Routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Admin Routes
    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', AdminDashboard::class)->name('dashboard');
        Route::get('/categories', AdminCategories::class)->name('categories');
        Route::get('/medicines', AdminMedicines::class)->name('medicines');
        Route::get('/doctors', AdminDoctors::class)->name('doctors');
        Route::get('/orders', function() { return 'Orders Management (Coming Soon)'; })->name('orders');
        Route::get('/appointments', function() { return 'Appointments Management (Coming Soon)'; })->name('appointments');
        Route::get('/users', function() { return 'Users Management (Coming Soon)'; })->name('users');
    });

    // User Profile (from Breeze)
    Route::view('profile', 'profile')->name('profile');
});

require __DIR__.'/auth.php';
