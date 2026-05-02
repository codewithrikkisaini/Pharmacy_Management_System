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
use App\Livewire\Admin\Banners as AdminBanners;
use App\Livewire\Admin\Blogs as AdminBlogs;
use App\Livewire\Admin\Settings as AdminSettings;

// Frontend Routes
Route::get('/', Home::class)->name('home');
Route::get('/medicines', Medicines::class)->name('medicines');
Route::get('/doctors', Doctors::class)->name('doctors');
Route::get('/contact', Contact::class)->name('contact');
Route::get('/cart', Cart::class)->name('cart');

// Authenticated Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/checkout', Checkout::class)->name('checkout');
    
    // Temporary Scripts
    Route::get('/migrate-db', function() {
        Artisan::call('migrate', ['--force' => true]);
        return Artisan::output();
    });

    Route::get('/storage-link', function() {
        Artisan::call('storage:link');
        return Artisan::output();
    });

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
        Route::get('/banners', AdminBanners::class)->name('banners');
        Route::get('/blogs', AdminBlogs::class)->name('blogs');
        Route::get('/settings', AdminSettings::class)->name('settings');
    });

    // User Profile (from Breeze)
    Route::view('profile', 'profile')->name('profile');
});

require __DIR__.'/auth.php';
