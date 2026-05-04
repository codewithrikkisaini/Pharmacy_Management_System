<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Medicine;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class MedicineDetail extends Component
{
    public $medicine;
    public $quantity = 1;

    public function mount($slug)
    {
        $this->medicine = Medicine::where('slug', $slug)->firstOrFail();
    }

    public function increment()
    {
        if ($this->quantity < $this->medicine->stock) {
            $this->quantity++;
        }
    }

    public function decrement()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function addToCart()
    {
        if ($this->medicine->stock < $this->quantity) {
            session()->flash('error', 'Not enough stock available!');
            return;
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$this->medicine->id])) {
            $cart[$this->medicine->id]['quantity'] += $this->quantity;
        } else {
            $cart[$this->medicine->id] = [
                'id' => $this->medicine->id,
                'name' => $this->medicine->name,
                'price' => $this->medicine->price,
                'image' => $this->medicine->image,
                'quantity' => $this->quantity,
            ];
        }

        session()->put('cart', $cart);
        $this->dispatch('cartUpdated');
        session()->flash('success', 'Medicine added to cart!');
    }

    public function render()
    {
        $related_medicines = Medicine::where('category_id', $this->medicine->category_id)
            ->where('id', '!=', $this->medicine->id)
            ->limit(4)
            ->get();

        return view('livewire.medicine-detail', [
            'related_medicines' => $related_medicines
        ])->layout('layouts.app');
    }
}
