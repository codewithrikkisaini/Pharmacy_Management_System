<div class="p-6 md:p-10">
    <div class="flex justify-between items-center mb-10">
        <div>
            <h1 class="text-3xl font-black">Appointments</h1>
            <p class="text-slate-500 font-medium">Manage doctor consultations and schedules.</p>
        </div>
    </div>

    @if(session()->has('message'))
        <div class="mb-8 bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 px-6 py-4 rounded-2xl font-bold text-sm">
            {{ session('message') }}
        </div>
    @endif

    <div class="glass rounded-[40px] overflow-hidden">
        <div class="p-8 border-b">
            <div class="relative w-full md:w-96">
                <input type="text" wire:model.live="search" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold focus:ring-2 focus:ring-indigo-500" placeholder="Search customer name...">
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left border-b bg-slate-50/50">
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Customer</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Doctor</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Date & Time</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Status</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach($appointments as $appointment)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-8 py-6">
                            <span class="font-bold text-slate-900">{{ $appointment->user->name }}</span>
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex flex-col">
                                <span class="font-bold text-indigo-600">{{ $appointment->doctor->name }}</span>
                                <span class="text-[10px] font-black text-slate-400 uppercase">{{ $appointment->doctor->specialization }}</span>
                            </div>
                        </td>
                        <td class="px-8 py-6 font-medium text-slate-500">
                            {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y h:i A') }}
                        </td>
                        <td class="px-8 py-6">
                            <span class="inline-block px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest 
                                @if($appointment->status == 'Pending') bg-amber-100 text-amber-600 @endif
                                @if($appointment->status == 'Approved') bg-blue-100 text-blue-600 @endif
                                @if($appointment->status == 'Completed') bg-emerald-100 text-emerald-600 @endif
                                @if($appointment->status == 'Cancelled') bg-red-100 text-red-600 @endif
                            ">
                                {{ $appointment->status }}
                            </span>
                        </td>
                        <td class="px-8 py-6 text-right space-x-2">
                            @if($appointment->status == 'Pending')
                                <button wire:click="updateStatus({{ $appointment->id }}, 'Approved')" class="text-blue-600 font-bold text-xs hover:underline">Approve</button>
                            @endif
                            @if($appointment->status == 'Approved')
                                <button wire:click="updateStatus({{ $appointment->id }}, 'Completed')" class="text-emerald-600 font-bold text-xs hover:underline">Complete</button>
                            @endif
                            @if($appointment->status != 'Cancelled' && $appointment->status != 'Completed')
                                <button wire:click="updateStatus({{ $appointment->id }}, 'Cancelled')" class="text-red-500 font-bold text-xs hover:underline">Cancel</button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="p-8 border-t">
            {{ $appointments->links() }}
        </div>
    </div>
</div>
