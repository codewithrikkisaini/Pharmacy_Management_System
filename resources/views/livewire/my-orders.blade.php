<div class="py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h1 class="text-4xl font-black mb-4">My Orders</h1>
                <p class="text-slate-500 font-medium">Track your recent orders and delivery status.</p>
            </div>
            <a href="{{ route('medicines') }}" class="text-indigo-600 font-bold hover:underline">Order more medicines &rarr;</a>
        </div>

        @if(session()->has('success'))
            <div class="mb-8 bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 px-8 py-6 rounded-[30px] font-bold">
                {{ session('success') }}
            </div>
        @endif

        <div class="space-y-8">
            @forelse($orders as $order)
            <div class="glass overflow-hidden rounded-[40px] border-2 border-transparent hover:border-indigo-50 transition-all">
                <div class="p-8 md:p-10 border-b border-slate-100 flex flex-col md:flex-row justify-between gap-6">
                    <div class="flex items-center gap-6">
                        <div class="w-16 h-16 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Order Number</p>
                            <p class="text-xl font-black">{{ $order->order_number }}</p>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-10">
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Placed On</p>
                            <p class="font-bold">{{ $order->created_at->format('M d, Y') }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Amount</p>
                            <p class="text-xl font-black text-indigo-600">${{ number_format($order->total_amount, 2) }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Status</p>
                            <span class="inline-block px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest 
                                @if($order->status == 'pending') bg-amber-100 text-amber-600 @endif
                                @if($order->status == 'processing') bg-blue-100 text-blue-600 @endif
                                @if($order->status == 'completed') bg-emerald-100 text-emerald-600 @endif
                                @if($order->status == 'rejected') bg-red-100 text-red-600 @endif
                            ">
                                {{ $order->status }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="p-8 md:p-10 bg-slate-50/30">
                    <h4 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-6">Items Ordered</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($order->items as $item)
                        <div class="flex items-center gap-4">
                            <img src="{{ $item->medicine->image ? asset('storage/'.$item->medicine->image) : 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80' }}" class="w-14 h-14 rounded-xl object-cover">
                            <div>
                                <p class="font-bold text-sm">{{ $item->medicine->name }}</p>
                                <p class="text-xs text-slate-500 font-medium">{{ $item->quantity }} x ${{ number_format($item->price, 2) }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @empty
            <div class="glass p-20 rounded-[40px] text-center">
                <div class="w-20 h-20 bg-indigo-50 rounded-full flex items-center justify-center mx-auto mb-6 text-indigo-300">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
                <h3 class="text-2xl font-black text-slate-900">No orders found</h3>
                <p class="text-slate-500 font-medium mt-2">You haven't placed any orders yet.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
