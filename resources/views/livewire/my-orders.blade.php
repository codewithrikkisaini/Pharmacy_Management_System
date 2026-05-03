<div class="py-24 bg-slate-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-16">
            <div class="space-y-4">
                <span class="bg-emerald-100 text-emerald-600 px-4 py-2 rounded-full text-[10px] font-black uppercase tracking-widest">Order History</span>
                <h1 class="text-5xl font-black text-slate-900 tracking-tight">Your <span class="text-emerald-600">Orders</span></h1>
            </div>
            <a href="{{ route('medicines') }}" class="group flex items-center space-x-3 text-emerald-600 font-black uppercase tracking-widest text-xs hover:text-emerald-700 transition-colors">
                <span>Shop More Products</span>
                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        </div>

        @if(session()->has('success'))
            <div class="mb-12 bg-emerald-500 text-white px-8 py-6 rounded-[32px] font-black text-sm shadow-xl shadow-emerald-200 animate-pulse">
                {{ session('success') }}
            </div>
        @endif

        <div class="space-y-12">
            @forelse($orders as $order)
            <div class="bg-white rounded-[50px] overflow-hidden shadow-xl shadow-slate-200/50 border border-white hover:border-emerald-100 transition-all duration-500">
                <div class="p-10 md:p-12 border-b border-slate-50 flex flex-col xl:flex-row justify-between gap-10">
                    <div class="flex items-center gap-8">
                        <div class="w-20 h-20 bg-emerald-50 rounded-3xl flex items-center justify-center text-emerald-600 shadow-sm">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        </div>
                        <div class="space-y-1">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Order Identification</p>
                            <p class="text-3xl font-black text-slate-900">{{ $order->order_number }}</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-10">
                        <div class="space-y-1">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Date Placed</p>
                            <p class="text-sm font-black text-slate-700 uppercase tracking-widest">{{ $order->created_at->format('M d, Y') }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Investment</p>
                            <p class="text-2xl font-black text-emerald-600 tracking-tight">${{ number_format($order->total_amount, 2) }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Delivery Status</p>
                            <span class="inline-block px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest 
                                @if($order->status == 'pending') bg-amber-50 text-amber-500 @endif
                                @if($order->status == 'processing') bg-blue-50 text-blue-500 @endif
                                @if($order->status == 'completed') bg-emerald-50 text-emerald-500 @endif
                                @if($order->status == 'rejected') bg-red-50 text-red-500 @endif
                            ">
                                {{ $order->status }}
                            </span>
                        </div>
                        <div class="flex items-center">
                            <button class="bg-slate-900 text-white px-6 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-emerald-600 transition-all">Track Link</button>
                        </div>
                    </div>
                </div>

                <div class="p-10 md:p-12 bg-slate-50/50">
                    <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] mb-8 px-2">Manifest Summary</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
                        @foreach($order->items as $item)
                        <div class="flex items-center gap-6 group">
                            <div class="w-16 h-16 rounded-2xl overflow-hidden shadow-md group-hover:scale-105 transition-transform duration-500">
                                <img src="{{ $item->medicine->image ? Storage::url($item->medicine->image) : 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80' }}" class="w-full h-full object-cover">
                            </div>
                            <div class="space-y-1">
                                <p class="font-black text-sm text-slate-900 leading-tight">{{ $item->medicine->name }}</p>
                                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">{{ $item->quantity }} Units</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @empty
            <div class="bg-white p-24 rounded-[60px] text-center shadow-xl shadow-slate-200/50 border border-white">
                <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-10 text-slate-300">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
                <h3 class="text-4xl font-black text-slate-900 mb-4 tracking-tight">No orders yet</h3>
                <p class="text-slate-500 font-medium text-lg mb-12 max-w-md mx-auto leading-relaxed">When you purchase items from our store, they will appear here for tracking.</p>
                <a href="{{ route('medicines') }}" class="inline-block bg-emerald-600 text-white px-12 py-5 rounded-3xl font-black shadow-2xl shadow-emerald-200 hover:bg-emerald-700 transition-all">Go to Store</a>
            </div>
            @endforelse
        </div>
    </div>
</div>
