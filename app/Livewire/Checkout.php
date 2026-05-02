<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Medicine;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class Checkout extends Component
{
    public $name;
    public $phone;
    public $address;
    public $payment_method = 'cash';

    public function mount()
    {
        if (empty(session()->get('cart'))) {
            return redirect()->route('medicines');
        }

        $this->name = auth()->user()->name;
    }

    protected $rules = [
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'address' => 'required|string',
    ];

    public function placeOrder()
    {
        $this->validate();

        $cart = session()->get('cart');
        $totalAmount = 0;
        foreach ($cart as $item) {
            $totalAmount += $item['price'] * $item['quantity'];
        }

        DB::beginTransaction();

        try {
            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => 'ORD-' . strtoupper(Str::random(10)),
                'customer_name' => $this->name,
                'customer_phone' => $this->phone,
                'customer_address' => $this->address,
                'total_amount' => $totalAmount,
                'status' => 'pending',
                'payment_method' => $this->payment_method,
            ]);

            foreach ($cart as $medicineId => $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'medicine_id' => $medicineId,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);

                // Reduce Stock
                $medicine = Medicine::find($medicineId);
                $medicine->decrement('stock', $item['quantity']);
            }

            DB::commit();

            session()->forget('cart');
            $this->dispatch('cartUpdated');
            session()->flash('success', 'Order placed successfully! Your order number is ' . $order->order_number);
            
            return redirect()->route('my-orders');

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('livewire.checkout', [
            'cartItems' => $cart,
            'total' => $total
        ])->layout('layouts.app');
    }
}
