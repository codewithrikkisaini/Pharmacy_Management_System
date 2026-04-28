<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Medicine;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Orders extends Component
{
    use WithPagination;

    // Search and Filter
    public $search = '';
    public $status_filter = '';
    public $date_from = '';
    public $date_to = '';

    // Create Order Form
    public $isCreateModalOpen = false;
    public $customer_name, $customer_phone, $customer_address, $payment_method = 'cash';
    public $selected_medicines = []; // Array of {id, quantity, price}
    public $current_medicine_id, $current_quantity = 1;

    protected $rules = [
        'customer_name' => 'required|string|max:255',
        'customer_phone' => 'required|string|max:20',
        'customer_address' => 'required|string',
        'payment_method' => 'required|in:cash,online',
        'selected_medicines' => 'required|array|min:1',
    ];

    public function updatedSearch() { $this->resetPage(); }
    public function updatedStatusFilter() { $this->resetPage(); }

    public function openCreateModal()
    {
        $this->resetForm();
        $this->isCreateModalOpen = true;
    }

    public function resetForm()
    {
        $this->customer_name = '';
        $this->customer_phone = '';
        $this->customer_address = '';
        $this->payment_method = 'cash';
        $this->selected_medicines = [];
    }

    public function addMedicine()
    {
        if (!$this->current_medicine_id) return;

        $medicine = Medicine::find($this->current_medicine_id);
        
        if ($medicine->stock < $this->current_quantity) {
            session()->flash('error', "Not enough stock for {$medicine->name}. Available: {$medicine->stock}");
            return;
        }

        // Check if already in list
        foreach ($this->selected_medicines as $index => $item) {
            if ($item['id'] == $medicine->id) {
                $this->selected_medicines[$index]['quantity'] += $this->current_quantity;
                return;
            }
        }

        $this->selected_medicines[] = [
            'id' => $medicine->id,
            'name' => $medicine->name,
            'quantity' => $this->current_quantity,
            'price' => $medicine->price,
        ];
    }

    public function removeMedicine($index)
    {
        unset($this->selected_medicines[$index]);
        $this->selected_medicines = array_values($this->selected_medicines);
    }

    public function store()
    {
        $this->validate();

        DB::transaction(function () {
            $total_amount = 0;
            foreach ($this->selected_medicines as $item) {
                $total_amount += $item['price'] * $item['quantity'];
            }

            $order = Order::create([
                'order_number' => 'ORD-' . strtoupper(Str::random(8)),
                'customer_name' => $this->customer_name,
                'customer_phone' => $this->customer_phone,
                'customer_address' => $this->customer_address,
                'total_amount' => $total_amount,
                'payment_method' => $this->payment_method,
                'status' => 'pending',
                'user_id' => auth()->id(),
            ]);

            foreach ($this->selected_medicines as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'medicine_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);

                // Reduce Stock
                $medicine = Medicine::find($item['id']);
                $medicine->decrement('stock', $item['quantity']);
            }
        });

        session()->flash('message', 'Order created successfully.');
        $this->isCreateModalOpen = false;
        $this->resetForm();
    }

    public function updateStatus($orderId, $newStatus)
    {
        $order = Order::findOrFail($orderId);
        $order->update(['status' => $newStatus]);
        session()->flash('message', 'Order status updated to ' . $newStatus);
    }

    public function deleteOrder($orderId)
    {
        Order::findOrFail($orderId)->delete();
        session()->flash('message', 'Order deleted (Soft Deleted).');
    }

    public function render()
    {
        $query = Order::query()
            ->when($this->search, function ($q) {
                $q->where('customer_name', 'like', '%' . $this->search . '%')
                  ->orWhere('order_number', 'like', '%' . $this->search . '%');
            })
            ->when($this->status_filter, function ($q) {
                $q->where('status', $this->status_filter);
            })
            ->when($this->date_from && $this->date_to, function ($q) {
                $q->whereBetween('created_at', [$this->date_from, $this->date_to]);
            });

        return view('livewire.admin.orders', [
            'orders' => $query->latest()->paginate(10),
            'medicines' => Medicine::where('stock', '>', 0)->get()
        ])->layout('layouts.admin');
    }
}
