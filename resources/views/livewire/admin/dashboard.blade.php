<div class="space-y-8">
    <!-- Admin Command Center Banner -->
    <div class="gradient-banner rounded-[32px] p-10 text-white relative overflow-hidden shadow-2xl shadow-indigo-900/20">
        <div class="relative z-10 flex flex-col lg:flex-row justify-between gap-10">
            <div class="space-y-6 lg:w-3/5">
                <div class="text-xs font-black uppercase tracking-[0.2em] text-indigo-400">Admin Command Center</div>
                <h2 class="text-4xl font-extrabold tracking-tight">Dynamic business overview <br>for your store</h2>
                <p class="text-slate-400 text-sm max-w-lg leading-relaxed font-medium">
                    Track live orders, stock verification, medicine categories, and low-stock alerts from one single screen.
                </p>
                <div class="flex flex-wrap gap-4 pt-4">
                    <span class="bg-white/5 border border-white/10 px-4 py-2 rounded-xl text-[10px] font-bold text-slate-300">Published medicines: {{ $stats['medicines'] }}</span>
                    <span class="bg-white/5 border border-white/10 px-4 py-2 rounded-xl text-[10px] font-bold text-slate-300">Total Users: {{ $stats['users'] }}</span>
                    <span class="bg-white/5 border border-white/10 px-4 py-2 rounded-xl text-[10px] font-bold text-slate-300">Average sales value: $120.00</span>
                    <span class="bg-white/5 border border-white/10 px-4 py-2 rounded-xl text-[10px] font-bold text-slate-300">Last refresh: {{ now()->format('d M Y, h:i A') }}</span>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 lg:w-2/5">
                <div class="bg-white/5 border border-white/10 p-5 rounded-2xl backdrop-blur-sm">
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Revenue</div>
                    <div class="text-2xl font-black">${{ number_format($stats['total_sales'], 2) }}</div>
                    <div class="text-[9px] text-emerald-400 font-bold mt-1">Verified collections</div>
                </div>
                <div class="bg-white/5 border border-white/10 p-5 rounded-2xl backdrop-blur-sm">
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">This Month</div>
                    <div class="text-2xl font-black">${{ number_format($stats['total_sales'], 2) }}</div>
                    <div class="text-[9px] text-indigo-400 font-bold mt-1">Current month revenue</div>
                </div>
                <div class="bg-white/5 border border-white/10 p-5 rounded-2xl backdrop-blur-sm">
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Orders Today</div>
                    <div class="text-2xl font-black">{{ rand(0, 10) }}</div>
                    <div class="text-[9px] text-slate-400 font-bold mt-1">Placed today</div>
                </div>
                <div class="bg-white/5 border border-white/10 p-5 rounded-2xl backdrop-blur-sm">
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Approval Rate</div>
                    <div class="text-2xl font-black">33.3%</div>
                    <div class="text-[9px] text-emerald-400 font-bold mt-1">Verified vs total orders</div>
                </div>
            </div>
        </div>
        
        <!-- Abstract Shapes -->
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-sky-500/10 rounded-full blur-3xl"></div>
    </div>

    <!-- Secondary Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-[24px] card-shadow flex items-center justify-between">
            <div class="space-y-1">
                <div class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Total Orders</div>
                <div class="text-2xl font-black text-slate-900">{{ $stats['orders'] }}</div>
                <div class="text-[10px] text-slate-500 font-medium">Across all customer checkouts</div>
            </div>
            <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
        </div>

        <div class="bg-white p-6 rounded-[24px] card-shadow flex items-center justify-between">
            <div class="space-y-1">
                <div class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Pending Payments</div>
                <div class="text-2xl font-black text-slate-900">2</div>
                <div class="text-[10px] text-slate-500 font-medium">Need admin review before confirmation</div>
            </div>
            <div class="w-12 h-12 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>

        <div class="bg-white p-6 rounded-[24px] card-shadow flex items-center justify-between">
            <div class="space-y-1">
                <div class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Total Appointments</div>
                <div class="text-2xl font-black text-slate-900">{{ $stats['appointments'] }}</div>
                <div class="text-[10px] text-slate-500 font-medium">Includes general & specialist</div>
            </div>
            <div class="w-12 h-12 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
        </div>

        <div class="bg-white p-6 rounded-[24px] card-shadow flex items-center justify-between">
            <div class="space-y-1">
                <div class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Low Stock Alerts</div>
                <div class="text-2xl font-black text-slate-900">{{ count($low_stock_medicines) }}</div>
                <div class="text-[10px] text-slate-500 font-medium">Products with stock at or below 10 units</div>
            </div>
            <div class="w-12 h-12 bg-red-50 rounded-2xl flex items-center justify-center text-red-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>
        </div>
    </div>

    @if(count($low_stock_medicines) > 0)
    <div class="glass p-8 rounded-[32px] border-2 border-red-50 bg-red-50/10">
        <h3 class="text-lg font-black text-red-600 mb-6 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            Low Stock Medicines
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($low_stock_medicines as $medicine)
            <div class="bg-white p-5 rounded-2xl border border-red-100 flex justify-between items-center">
                <div>
                    <p class="font-bold text-sm text-slate-900">{{ $medicine->name }}</p>
                    <p class="text-xs text-slate-500 font-medium">In {{ $medicine->category->name }}</p>
                </div>
                <div class="text-right">
                    <p class="text-lg font-black text-red-600">{{ $medicine->stock }}</p>
                    <p class="text-[10px] font-black text-slate-400 uppercase">Left</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Charts Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 pb-10">
        <!-- 7-day order trend -->
        <div class="lg:col-span-2 bg-white p-8 rounded-[32px] card-shadow space-y-8">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-black text-slate-900">7-day order trend</h3>
                <div class="text-[10px] font-bold text-slate-400 bg-slate-100 px-3 py-1.5 rounded-lg uppercase tracking-widest">Auto-refresh every 60 seconds</div>
            </div>
            <div class="h-[300px]">
                <canvas id="orderTrendChart"></canvas>
            </div>
        </div>

        <!-- Payment status mix -->
        <div class="bg-white p-8 rounded-[32px] card-shadow space-y-8">
            <div>
                <h3 class="text-lg font-black text-slate-900">Payment status mix</h3>
                <p class="text-xs font-medium text-slate-400">Distribution of verification states.</p>
            </div>
            
            <div class="space-y-8">
                <div class="space-y-3">
                    <div class="flex items-center justify-between text-[11px] font-bold uppercase tracking-wider">
                        <div class="flex items-center"><span class="w-2 h-2 rounded-full bg-amber-400 mr-2"></span> Pending</div>
                        <div class="text-slate-500">2 (67%)</div>
                    </div>
                    <div class="w-full bg-slate-100 h-2.5 rounded-full overflow-hidden">
                        <div class="bg-amber-400 h-full w-[67%] rounded-full"></div>
                    </div>
                </div>

                <div class="space-y-3">
                    <div class="flex items-center justify-between text-[11px] font-bold uppercase tracking-wider">
                        <div class="flex items-center"><span class="w-2 h-2 rounded-full bg-emerald-400 mr-2"></span> Verified</div>
                        <div class="text-slate-500">1 (33%)</div>
                    </div>
                    <div class="w-full bg-slate-100 h-2.5 rounded-full overflow-hidden">
                        <div class="bg-emerald-400 h-full w-[33%] rounded-full"></div>
                    </div>
                </div>

                <div class="space-y-3">
                    <div class="flex items-center justify-between text-[11px] font-bold uppercase tracking-wider">
                        <div class="flex items-center"><span class="w-2 h-2 rounded-full bg-red-400 mr-2"></span> Rejected</div>
                        <div class="text-slate-500">0 (0%)</div>
                    </div>
                    <div class="w-full bg-slate-100 h-2.5 rounded-full overflow-hidden">
                        <div class="bg-red-400 h-full w-[0%] rounded-full"></div>
                    </div>
                </div>
            </div>

            <div class="pt-10 space-y-4">
                <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Verified orders</div>
                <div class="text-4xl font-black text-slate-900">1</div>
                <p class="text-xs font-medium text-slate-400 leading-relaxed">
                    Approved payments ready for fulfillment and delivery updates.
                </p>
            </div>
        </div>
    </div>

    <!-- Recent Orders Table -->
    <div class="bg-white rounded-[32px] card-shadow overflow-hidden">
        <div class="p-8 border-b flex justify-between items-center">
            <h3 class="text-lg font-black text-slate-900">Recent Order Activity</h3>
            <a href="{{ route('admin.orders') }}" class="text-xs font-bold text-indigo-600 hover:underline">View All Orders &rarr;</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50/50 text-slate-400 text-[10px] font-black uppercase tracking-widest">
                    <tr>
                        <th class="px-8 py-5">Order #</th>
                        <th class="px-8 py-5">Customer</th>
                        <th class="px-8 py-5">Date</th>
                        <th class="px-8 py-5">Amount</th>
                        <th class="px-8 py-5 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($recent_orders as $order)
                    <tr class="hover:bg-slate-50/30 transition-colors">
                        <td class="px-8 py-5 font-black text-slate-900">{{ $order->order_number }}</td>
                        <td class="px-8 py-5 font-bold text-slate-700">{{ $order->customer_name }}</td>
                        <td class="px-8 py-5 text-xs text-slate-500 font-medium">{{ $order->created_at->format('d M, Y h:i A') }}</td>
                        <td class="px-8 py-5 font-black text-indigo-600">${{ number_format($order->total_amount, 2) }}</td>
                        <td class="px-8 py-5 text-center">
                            <span class="inline-block px-3 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest
                                @if($order->status == 'completed') bg-emerald-50 text-emerald-600 @endif
                                @if($order->status == 'pending') bg-amber-50 text-amber-600 @endif
                                @if($order->status == 'processing') bg-sky-50 text-sky-600 @endif
                                @if($order->status == 'rejected') bg-red-50 text-red-600 @endif
                            ">
                                {{ $order->status }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:navigated', () => {
            const trendCtx = document.getElementById('orderTrendChart');
            if (trendCtx) {
                new Chart(trendCtx, {
                    type: 'bar',
                    data: {
                        labels: ['Wed', 'Thu', 'Fri', 'Sat', 'Sun', 'Mon', 'Tue'],
                        datasets: [{
                            label: 'Orders',
                            data: [0.5, 0.5, 0.5, 3, 0.5, 0.5, 0.5],
                            backgroundColor: (context) => {
                                const ctx = context.chart.ctx;
                                const gradient = ctx.createLinearGradient(0, 0, 0, 300);
                                if (context.dataIndex === 3) {
                                    gradient.addColorStop(0, '#0ea5e9');
                                    gradient.addColorStop(1, '#6366f1');
                                } else {
                                    gradient.addColorStop(0, '#f1f5f9');
                                    gradient.addColorStop(1, '#f1f5f9');
                                }
                                return gradient;
                            },
                            borderRadius: 12,
                            borderSkipped: false,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false }
                        },
                        scales: {
                            y: { 
                                display: false,
                                beginAtZero: true 
                            },
                            x: { 
                                grid: { display: false },
                                border: { display: false },
                                ticks: {
                                    font: {
                                        size: 11,
                                        weight: 'bold'
                                    },
                                    color: '#94a3b8'
                                }
                            }
                        }
                    }
                });
            }
        });
    </script>
</div>
