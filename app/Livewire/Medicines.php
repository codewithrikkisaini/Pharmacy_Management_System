<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Medicine;
use App\Models\Category;
use Livewire\WithPagination;

class Medicines extends Component
{
    use WithPagination;

    public $search = '';
    public $category_id = '';
    public $type = '';

    public function updatingSearch()
    {
        $this->resetPage();
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

    public function render()
    {
        $medicines = Medicine::query()
            ->when($this->search, fn($q) => $q->where('name', 'like', '%'.$this->search.'%'))
            ->when($this->category_id, fn($q) => $q->where('category_id', $this->category_id))
            ->when($this->type, fn($q) => $q->where('type', $this->type))
            ->where('status', true)
            ->latest()
            ->paginate(12);

        return view('livewire.medicines', [
            'medicines' => $medicines,
            'categories' => Category::all(),
        ])->layout('layouts.app');
    }
}
