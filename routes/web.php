<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Livewire\Home;
use App\Livewire\Medicines;
use App\Livewire\Doctors;
use App\Livewire\Cart;
use App\Livewire\Checkout;
use App\Livewire\MyOrders;
use App\Livewire\Contact;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\Categories as AdminCategories;
use App\Livewire\Admin\Medicines as AdminMedicines;
use App\Livewire\Admin\Doctors as AdminDoctors;
use App\Livewire\Admin\Orders as AdminOrders;
use App\Livewire\Admin\Users as AdminUsers;
use App\Livewire\Admin\Appointments as AdminAppointments;
use App\Livewire\Admin\Messages as AdminMessages;

// Temporary Migration Route
Route::get('/migrate-db', function() {
    try {
        \Illuminate\Support\Facades\DB::statement("
            CREATE TABLE IF NOT EXISTS contact_messages (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL,
                message TEXT NOT NULL,
                is_read BOOLEAN DEFAULT FALSE,
                created_at TIMESTAMP NULL,
                updated_at TIMESTAMP NULL
            )
        ");
        return "Table 'contact_messages' created successfully using raw SQL!";
    } catch (\Exception $e) {
        return "Failed to create table: " . $e->getMessage();
    }
});

// Frontend Routes
Route::get('/', Home::class)->name('home');
Route::get('/medicines', Medicines::class)->name('medicines');
Route::get('/doctors', Doctors::class)->name('doctors');
Route::get('/contact', Contact::class)->name('contact');
Route::get('/cart', Cart::class)->name('cart');

// Authenticated Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/checkout', Checkout::class)->name('checkout');
    Route::get('/my-orders', MyOrders::class)->name('my-orders');
    
    // Admin Routes
    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', AdminDashboard::class)->name('dashboard');
        Route::get('/categories', AdminCategories::class)->name('categories');
        Route::get('/medicines', AdminMedicines::class)->name('medicines');
        Route::get('/doctors', AdminDoctors::class)->name('doctors');
        Route::get('/orders', AdminOrders::class)->name('orders');
        Route::get('/users', AdminUsers::class)->name('users');
        Route::get('/appointments', AdminAppointments::class)->name('appointments');
        Route::get('/messages', AdminMessages::class)->name('messages');
    });

    // User Profile (from Breeze)
    Route::view('profile', 'profile')->name('profile');
});

require __DIR__.'/auth.php';
