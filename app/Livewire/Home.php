<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Medicine;

class Home extends Component
{
    public $search = '';

    public function performSearch()
    {
        return redirect()->route('medicines', ['search' => $this->search]);
    }

    public function addToCart($medicineId)
    {
        $medicine = Medicine::find($medicineId);
        
        if (!$medicine || $medicine->stock <= 0) {
            session()->flash('error', 'Medicine out of stock!');
            return;
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$medicineId])) {
            if ($cart[$medicineId]['quantity'] < $medicine->stock) {
                $cart[$medicineId]['quantity']++;
            } else {
                session()->flash('error', 'Maximum available stock reached!');
                return;
            }
        } else {
            $cart[$medicineId] = [
                'name' => $medicine->name,
                'quantity' => 1,
                'price' => $medicine->price,
                'image' => $medicine->image
            ];
        }

        session()->put('cart', $cart);
        $this->dispatch('cartUpdated');
        session()->flash('success', 'Added to cart successfully!');
    }

    public function mount()
    {
        if (auth()->check() && auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
    }

    public function render()
    {
        $banners = \App\Models\Banner::where('status', true)->orderBy('order')->get();
        $categories = Category::all();
        $latest_medicines = Medicine::with('category')->where('status', true)->latest()->take(8)->get();
        $doctors = \App\Models\Doctor::where('status', true)->latest()->take(4)->get();

        return view('livewire.home', [
            'banners' => $banners,
            'categories' => $categories,
            'latest_medicines' => $latest_medicines,
            'doctors' => $doctors,
        ])->layout('layouts.app');
    }
}
