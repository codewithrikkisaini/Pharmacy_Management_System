<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Medicine;

class Home extends Component
{
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

    public function render()
    {
        $categories = Category::all();
        $latest_medicines = Medicine::with('category')->where('status', true)->latest()->take(8)->get();

        return view('livewire.home', [
            'categories' => $categories,
            'latest_medicines' => $latest_medicines,
        ])->layout('layouts.app');
    }
}
