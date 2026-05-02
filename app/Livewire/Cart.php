<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Medicine;

class Cart extends Component
{
    public $cart = [];

    protected $listeners = ['cartUpdated' => 'loadCart'];

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        $this->cart = session()->get('cart', []);
    }

    public function incrementQuantity($medicineId)
    {
        if (isset($this->cart[$medicineId])) {
            $medicine = Medicine::find($medicineId);
            if ($this->cart[$medicineId]['quantity'] < $medicine->stock) {
                $this->cart[$medicineId]['quantity']++;
                session()->put('cart', $this->cart);
                $this->dispatch('cartUpdated');
            } else {
                session()->flash('error', 'Not enough stock available.');
            }
        }
    }

    public function decrementQuantity($medicineId)
    {
        if (isset($this->cart[$medicineId]) && $this->cart[$medicineId]['quantity'] > 1) {
            $this->cart[$medicineId]['quantity']--;
            session()->put('cart', $this->cart);
            $this->dispatch('cartUpdated');
        }
    }

    public function removeItem($medicineId)
    {
        if (isset($this->cart[$medicineId])) {
            unset($this->cart[$medicineId]);
            session()->put('cart', $this->cart);
            $this->dispatch('cartUpdated');
        }
    }

    public function render()
    {
        $total = 0;
        foreach ($this->cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('livewire.cart', [
            'cartItems' => $this->cart,
            'total' => $total
        ])->layout('layouts.app');
    }
}
