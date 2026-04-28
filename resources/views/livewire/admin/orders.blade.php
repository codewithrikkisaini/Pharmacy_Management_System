<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Order Management</h2>
            <p class="text-sm font-medium text-slate-500 mt-1">Monitor sales and handle customer prescriptions.</p>
        </div>
        <button wire:click="openCreateModal" class="bg-sky-500 hover:bg-sky-600 text-white px-8 py-3.5 rounded-2xl font-bold transition-all shadow-lg shadow-sky-100 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Create New Order
        </button>
    </div>

    @if (session()->has('message'))
        <div class="bg-emerald-50 border border-emerald-100 text-emerald-700 px-6 py-4 rounded-2xl flex items-center font-bold text-sm">
            {{ session('message') }}
        </div>
    @endif

    <!-- Filters Section -->
    <div class="bg-white p-8 rounded-[32px] card-shadow grid grid-cols-1 md:grid-cols-4 gap-6 items-end">
        <div class="space-y-2">
            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-1">Search</label>
            <div class="relative">
                <input type="text" wire:model.live="search" placeholder="Order # or Customer..." class="w-full bg-slate-50 border-none rounded-xl px-5 py-3 text-sm focus:ring-2 focus:ring-sky-500">
            </div>
        </div>
        <div class="space-y-2">
            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-1">Status</label>
            <select wire:model.live="status_filter" class="w-full bg-slate-50 border-none rounded-xl px-5 py-3 text-sm font-bold focus:ring-2 focus:ring-sky-500">
                <option value="">All Statuses</option>
                <option value="pending">Pending</option>
                <option value="processing">Processing</option>
                <option value="completed">Completed</option>
                <option value="rejected">Rejected</option>
                <option value="on_hold">On Hold</option>
                <option value="in_transit">In Transit</option>
            </select>
        </div>
        <div class="space-y-2">
            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-1">From Date</label>
            <input type="date" wire:model.live="date_from" class="w-full bg-slate-50 border-none rounded-xl px-5 py-3 text-sm focus:ring-2 focus:ring-sky-500 font-bold">
        </div>
        <div class="space-y-2">
            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-1">To Date</label>
            <input type="date" wire:model.live="date_to" class="w-full bg-slate-50 border-none rounded-xl px-5 py-3 text-sm focus:ring-2 focus:ring-sky-500 font-bold">
        </div>
    </div>

    <!-- Orders Table -->
    <div class="bg-white rounded-[32px] card-shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50/50 text-slate-400 text-[11px] font-bold uppercase tracking-[0.1em]">
                    <tr>
                        <th class="px-8 py-5">Order Details</th>
                        <th class="px-8 py-5">Customer Info</th>
                        <th class="px-8 py-5">Amount</th>
                        <th class="px-8 py-5 text-center">Status</th>
                        <th class="px-8 py-5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($orders as $order)
                    <tr class="hover:bg-slate-50/30 transition-colors">
                        <td class="px-8 py-6">
                            <div class="font-black text-slate-900">{{ $order->order_number }}</div>
                            <div class="text-[10px] font-bold text-slate-400 uppercase mt-1">{{ $order->created_at->format('d M Y, h:i A') }}</div>
                        </td>
                        <td class="px-8 py-6">
                            <div class="font-bold text-slate-900">{{ $order->customer_name }}</div>
                            <div class="text-xs text-slate-500 font-medium mt-0.5">{{ $order->customer_phone }}</div>
                        </td>
                        <td class="px-8 py-6">
                            <div class="text-lg font-black text-slate-900">${{ number_format($order->total_amount, 2) }}</div>
                            <div class="text-[9px] font-black uppercase text-indigo-500">{{ $order->payment_method }}</div>
                        </td>
                        <td class="px-8 py-6 text-center">
                            <select wire:change="updateStatus({{ $order->id }}, $event.target.value)" class="text-xs font-black uppercase tracking-widest px-4 py-2 rounded-xl border-none ring-1 ring-slate-100 focus:ring-2 focus:ring-sky-500 cursor-pointer 
                                {{ $order->status == 'completed' ? 'bg-emerald-50 text-emerald-600' : '' }}
                                {{ $order->status == 'pending' ? 'bg-amber-50 text-amber-600' : '' }}
                                {{ $order->status == 'processing' ? 'bg-sky-50 text-sky-600' : '' }}
                                {{ $order->status == 'rejected' ? 'bg-red-50 text-red-600' : '' }}">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="rejected" {{ $order->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                <option value="on_hold" {{ $order->status == 'on_hold' ? 'selected' : '' }}>On Hold</option>
                                <option value="in_transit" {{ $order->status == 'in_transit' ? 'selected' : '' }}>In Transit</option>
                            </select>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <button onclick="confirm('Archive this order?') || event.stopImmediatePropagation()" wire:click="deleteOrder({{ $order->id }})" class="text-red-500 hover:text-red-700 bg-red-50 p-2.5 rounded-xl transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-20 text-center text-slate-400 font-bold">No orders found matching your criteria.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-8 border-t border-slate-50">
            {{ $orders->links() }}
        </div>
    </div>

    <!-- Create Order Modal -->
    @if($isCreateModalOpen)
    <div class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm">
        <div class="bg-white w-full max-w-4xl rounded-[40px] shadow-2xl overflow-hidden flex flex-col max-h-[90vh]">
            <div class="p-10 border-b border-slate-50 flex justify-between items-center bg-slate-50/30">
                <div>
                    <h3 class="text-2xl font-black text-slate-900">Create New Order</h3>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Process a new sale</p>
                </div>
                <button wire:click="$set('isCreateModalOpen', false)" class="text-slate-400 hover:text-slate-900 bg-white p-2 rounded-full shadow-sm transition-all">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <div class="flex-1 overflow-y-auto p-10 grid grid-cols-2 gap-10">
                <!-- Customer Details -->
                <div class="space-y-6">
                    <h4 class="text-sm font-black text-sky-500 uppercase tracking-widest">Customer Information</h4>
                    <div class="space-y-4">
                        <input type="text" wire:model="customer_name" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold text-sm" placeholder="Full Name">
                        @error('customer_name') <span class="text-red-500 text-[10px] font-bold">{{ $message }}</span> @enderror
                        
                        <input type="text" wire:model="customer_phone" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold text-sm" placeholder="Phone Number">
                        @error('customer_phone') <span class="text-red-500 text-[10px] font-bold">{{ $message }}</span> @enderror
                        
                        <textarea wire:model="customer_address" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold text-sm" placeholder="Address"></textarea>
                        @error('customer_address') <span class="text-red-500 text-[10px] font-bold">{{ $message }}</span> @enderror
                        
                        <select wire:model="payment_method" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold text-sm">
                            <option value="cash">Cash Payment</option>
                            <option value="online">Online Payment</option>
                        </select>
                    </div>
                </div>

                <!-- Medicine Selector -->
                <div class="space-y-6">
                    <h4 class="text-sm font-black text-sky-500 uppercase tracking-widest">Select Medicines</h4>
                    <div class="flex items-center gap-2">
                        <select wire:model="current_medicine_id" class="flex-1 bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold text-sm">
                            <option value="">Select Medicine</option>
                            @foreach($medicines as $med)
                                <option value="{{ $med->id }}">{{ $med->name }} (${{ $med->price }})</option>
                            @endforeach
                        </select>
                        <input type="number" wire:model="current_quantity" class="w-20 bg-slate-50 border-none rounded-2xl px-4 py-4 font-bold text-sm text-center">
                        <button wire:click="addMedicine" class="bg-slate-900 text-white p-4 rounded-2xl hover:bg-slate-800 transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        </button>
                    </div>

                    @if(session()->has('error'))
                        <div class="text-red-500 text-[10px] font-bold px-2">{{ session('error') }}</div>
                    @endif

                    <div class="bg-slate-50 rounded-3xl p-6 space-y-4">
                        <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest border-b pb-2">Order Items</div>
                        @foreach($selected_medicines as $index => $item)
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="text-sm font-bold text-slate-900">{{ $item['name'] }}</div>
                                    <div class="text-[10px] font-bold text-slate-400">{{ $item['quantity'] }} x ${{ $item['price'] }}</div>
                                </div>
                                <button wire:click="removeMedicine({{ $index }})" class="text-red-400 hover:text-red-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            </div>
                        @endforeach
                        
                        @if(count($selected_medicines) > 0)
                            <div class="pt-4 border-t flex items-center justify-between">
                                <div class="text-xs font-black uppercase text-slate-400">Total</div>
                                <div class="text-xl font-black text-slate-900">
                                    ${{ number_format(collect($selected_medicines)->sum(fn($i) => $i['price'] * $i['quantity']), 2) }}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="p-10 border-t bg-slate-50/30">
                <button wire:click="store" class="w-full bg-sky-500 hover:bg-sky-600 text-white font-black py-5 rounded-2xl shadow-xl shadow-sky-100 transition-all">
                    Finalize & Place Order
                </button>
            </div>
        </div>
    </div>
    @endif
</div>
