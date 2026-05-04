<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public function render()
    {
        $user = Auth::user();
        
        $stats = [
            'total_orders' => Order::where('user_id', $user->id)->count(),
            'pending_orders' => Order::where('user_id', $user->id)->where('status', 'pending')->count(),
            'total_appointments' => Appointment::where('user_id', $user->id)->count(),
            'recent_orders' => Order::where('user_id', $user->id)->latest()->take(5)->get(),
        ];

        return view('livewire.dashboard', [
            'stats' => $stats,
            'user' => $user
        ])->layout('layouts.app');
    }
}
