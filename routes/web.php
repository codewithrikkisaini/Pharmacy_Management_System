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
use App\Livewire\MedicineDetail;
use App\Livewire\Profile;
use App\Livewire\Blogs;
use App\Livewire\BlogDetail;
use App\Livewire\About;
use App\Livewire\Faq;
use App\Livewire\HowToOrder;

Route::get('/fix-images', function() {
    try {
        Artisan::call('storage:link');
        return "Images Link ban gaya hai! Ab homepage refresh karke check karein.";
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage();
    }
});

Route::get('/fix-admin', function() {
    $user = \App\Models\User::where('email', 'rikkisaini4455@gmail.com')->first();
    
    if (!$user) {
        $user = \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'rikkisaini4455@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('admin123'),
            'role' => 'admin'
        ]);
    } else {
        $user->update([
            'role' => 'admin',
            'password' => \Illuminate\Support\Facades\Hash::make('admin123')
        ]);
    }

    auth()->login($user);
    return redirect()->route('admin.dashboard');
});

// Frontend Routes
Route::get('/', Home::class)->name('home');
Route::get('/medicines', Medicines::class)->name('medicines');
Route::get('/medicine/{slug}', MedicineDetail::class)->name('medicine.detail');
Route::get('/doctors', Doctors::class)->name('doctors');
Route::get('/contact', Contact::class)->name('contact');
Route::get('/cart', Cart::class)->name('cart');
Route::get('/profile', Profile::class)->middleware('auth')->name('profile');
Route::get('/blogs', Blogs::class)->name('blogs');
Route::get('/blog/{slug}', BlogDetail::class)->name('blog.detail');
Route::get('/about', About::class)->name('about');
Route::get('/faq', Faq::class)->name('faq');
Route::get('/how-to-order', HowToOrder::class)->name('how-to-order');

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
});

require __DIR__.'/auth.php';
