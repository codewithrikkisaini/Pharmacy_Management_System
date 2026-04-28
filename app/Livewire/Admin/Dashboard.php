<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Medicine;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Appointment;

class Dashboard extends Component
{
    public function render()
    {
        $stats = [
            'medicines' => Medicine::count(),
            'categories' => Category::count(),
            'orders' => Order::count(),
            'users' => User::where('role', 'user')->count(),
            'doctors' => Doctor::count(),
            'appointments' => Appointment::count(),
            'total_sales' => Order::where('status', 'Completed')->sum('total_amount'),
        ];

        $recent_orders = Order::with('user')->latest()->take(5)->get();

        return view('livewire.admin.dashboard', [
            'stats' => $stats,
            'recent_orders' => $recent_orders,
        ])->layout('layouts.admin');
    }
}
