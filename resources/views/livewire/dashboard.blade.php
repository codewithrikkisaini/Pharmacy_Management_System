<div class="py-24 bg-slate-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Welcome Section -->
        <div class="mb-12 flex flex-col md:flex-row md:items-center justify-between gap-8">
            <div class="space-y-4">
                <span class="bg-emerald-100 text-emerald-600 px-4 py-2 rounded-full text-[10px] font-black uppercase tracking-widest">Customer Dashboard</span>
                <h1 class="text-5xl font-black text-slate-900 leading-tight">Welcome back, <span class="text-emerald-600">{{ $user->name }}!</span></h1>
                <p class="text-slate-500 font-medium">Here's what's happening with your account today.</p>
            </div>
            <div class="flex gap-4">
                <a href="{{ route('medicines') }}" class="bg-emerald-600 text-white px-8 py-4 rounded-2xl font-black text-sm shadow-xl shadow-emerald-100 hover:bg-emerald-700 transition-all flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    Order Medicines
                </a>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
            <div class="bg-white p-10 rounded-[48px] shadow-sm border border-slate-100 flex items-center gap-8">
                <div class="w-16 h-16 bg-emerald-50 rounded-3xl flex items-center justify-center text-emerald-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
                <div>
                    <div class="text-4xl font-black text-slate-900">{{ $stats['total_orders'] }}</div>
                    <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Orders</div>
                </div>
            </div>

            <div class="bg-white p-10 rounded-[48px] shadow-sm border border-slate-100 flex items-center gap-8">
                <div class="w-16 h-16 bg-amber-50 rounded-3xl flex items-center justify-center text-amber-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <div class="text-4xl font-black text-slate-900">{{ $stats['pending_orders'] }}</div>
                    <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Pending Delivery</div>
                </div>
            </div>

            <div class="bg-white p-10 rounded-[48px] shadow-sm border border-slate-100 flex items-center gap-8">
                <div class="w-16 h-16 bg-blue-50 rounded-3xl flex items-center justify-center text-blue-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <div>
                    <div class="text-4xl font-black text-slate-900">{{ $stats['total_appointments'] }}</div>
                    <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Appointments</div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Recent Orders -->
            <div class="lg:col-span-2 space-y-8">
                <div class="flex items-center justify-between px-4">
                    <h3 class="text-2xl font-black text-slate-900">Recent Orders</h3>
                    <a href="{{ route('my-orders') }}" class="text-[10px] font-black text-emerald-600 uppercase tracking-widest hover:underline">View All</a>
                </div>
                <div class="bg-white rounded-[48px] shadow-sm border border-slate-100 overflow-hidden">
                    <table class="w-full text-left">
                        <thead class="bg-slate-50/50 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                            <tr>
                                <th class="px-10 py-6">Order #</th>
                                <th class="px-10 py-6">Status</th>
                                <th class="px-10 py-6">Amount</th>
                                <th class="px-10 py-6 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($stats['recent_orders'] as $order)
                            <tr class="hover:bg-slate-50/30 transition-all">
                                <td class="px-10 py-6">
                                    <div class="font-bold text-slate-900">#{{ $order->order_number }}</div>
                                    <div class="text-[10px] font-bold text-slate-400">{{ $order->created_at->format('M d, Y') }}</div>
                                </td>
                                <td class="px-10 py-6">
                                    <span class="px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest {{ 
                                        $order->status === 'completed' ? 'bg-emerald-100 text-emerald-600' : 
                                        ($order->status === 'pending' ? 'bg-amber-100 text-amber-600' : 'bg-slate-100 text-slate-600') 
                                    }}">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td class="px-10 py-6 font-black text-slate-900">${{ number_format($order->total_amount, 2) }}</td>
                                <td class="px-10 py-6 text-right">
                                    <a href="{{ route('my-orders') }}" class="text-emerald-600 font-black text-[10px] uppercase tracking-widest">Detail</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-10 py-20 text-center text-slate-400 font-bold italic">No orders placed yet.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Quick Profile Summary -->
            <div class="space-y-8">
                <h3 class="text-2xl font-black text-slate-900 px-4">Profile Summary</h3>
                <div class="bg-emerald-600 rounded-[48px] p-10 text-white space-y-10 shadow-2xl shadow-emerald-200">
                    <div class="flex items-center gap-6">
                        <div class="w-16 h-16 bg-white/20 rounded-3xl flex items-center justify-center text-3xl font-black">{{ substr($user->name, 0, 1) }}</div>
                        <div>
                            <div class="font-black text-xl">{{ $user->name }}</div>
                            <div class="text-xs font-bold opacity-60">{{ $user->email }}</div>
                        </div>
                    </div>
                    
                    <div class="space-y-6 pt-6 border-t border-white/10">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-white/10 rounded-2xl flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </div>
                            <span class="text-sm font-bold">{{ $user->phone ?? 'Add phone number' }}</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-white/10 rounded-2xl flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <span class="text-sm font-bold line-clamp-1">{{ $user->address ?? 'Add address' }}</span>
                        </div>
                    </div>

                    <a href="{{ route('profile') }}" class="block w-full bg-white text-emerald-600 py-5 rounded-2xl font-black text-sm text-center hover:bg-slate-50 transition-all">
                        Manage Profile
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
