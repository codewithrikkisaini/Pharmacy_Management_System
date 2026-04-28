<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Medicine;

class Home extends Component
{
    public function render()
    {
        $categories = Category::all();
        $latest_medicines = Medicine::with('category')->latest()->take(8)->get();

        return view('livewire.home', [
            'categories' => $categories,
            'latest_medicines' => $latest_medicines,
        ])->layout('layouts.app');
    }
}
