<div class="p-10 space-y-10">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div class="space-y-4">
            <span class="bg-emerald-100 text-emerald-600 px-4 py-2 rounded-full text-[10px] font-black uppercase tracking-widest">Medical Scheduling</span>
            <h1 class="text-5xl font-black text-slate-900 tracking-tight">Patient <span class="text-emerald-600">Appointments</span></h1>
        </div>
        <div class="relative group">
            <input type="text" wire:model.live="search" class="w-full md:w-80 bg-white border-none rounded-2xl px-12 py-5 font-bold text-slate-700 shadow-sm focus:ring-2 focus:ring-emerald-500 transition-all" placeholder="Search patient name...">
            <svg class="w-5 h-5 text-slate-400 absolute left-4 top-5 group-hover:text-emerald-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </div>
    </div>

    @if(session()->has('message'))
        <div class="bg-emerald-500 text-white px-8 py-6 rounded-[32px] font-black text-sm shadow-xl shadow-emerald-200 animate-pulse">
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-white rounded-[50px] shadow-xl shadow-slate-200/50 border border-white overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="text-left bg-slate-50/50 border-b border-slate-50">
                        <th class="px-10 py-8 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Patient Details</th>
                        <th class="px-10 py-8 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Medical Specialist</th>
                        <th class="px-10 py-8 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Scheduled Date</th>
                        <th class="px-10 py-8 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Clinical Status</th>
                        <th class="px-10 py-8 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($appointments as $appointment)
                    <tr class="hover:bg-slate-50/30 transition-all group">
                        <td class="px-10 py-8">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-slate-100 rounded-2xl flex items-center justify-center text-slate-400 font-black text-sm">
                                    {{ substr($appointment->user->name, 0, 1) }}
                                </div>
                                <div class="flex flex-col">
                                    <span class="font-black text-slate-900">{{ $appointment->user->name }}</span>
                                    @if($appointment->message)
                                        <span class="text-[9px] font-bold text-emerald-600 uppercase tracking-widest">{{ $appointment->message }}</span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-10 py-8">
                            <div class="flex flex-col space-y-1">
                                <span class="font-black text-emerald-600 tracking-tight">{{ $appointment->doctor->name }}</span>
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ $appointment->doctor->specialization }}</span>
                            </div>
                        </td>
                        <td class="px-10 py-8">
                            <div class="flex items-center space-x-3 text-slate-500">
                                <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span class="text-sm font-bold">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}</span>
                                <span class="text-[10px] font-black bg-slate-100 px-2 py-1 rounded-lg uppercase">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('h:i A') }}</span>
                            </div>
                        </td>
                        <td class="px-10 py-8">
                            <span class="inline-block px-5 py-2 rounded-full text-[10px] font-black uppercase tracking-widest 
                                @if($appointment->status == 'Pending') bg-amber-50 text-amber-600 border border-amber-100 @endif
                                @if($appointment->status == 'Approved') bg-blue-50 text-blue-600 border border-blue-100 @endif
                                @if($appointment->status == 'Completed') bg-emerald-50 text-emerald-600 border border-emerald-100 @endif
                                @if($appointment->status == 'Cancelled') bg-red-50 text-red-600 border border-red-100 @endif
                            ">
                                {{ $appointment->status }}
                            </span>
                        </td>
                        <td class="px-10 py-8 text-right">
                            <div class="flex items-center justify-end space-x-3">
                                @if($appointment->status == 'Pending')
                                    <button wire:click="updateStatus({{ $appointment->id }}, 'Approved')" class="bg-emerald-50 text-emerald-600 px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-emerald-600 hover:text-white transition-all shadow-sm">Approve</button>
                                @endif
                                @if($appointment->status == 'Approved')
                                    <button wire:click="updateStatus({{ $appointment->id }}, 'Completed')" class="bg-slate-900 text-white px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-emerald-600 transition-all shadow-sm">Mark Complete</button>
                                @endif
                                @if($appointment->status != 'Cancelled' && $appointment->status != 'Completed')
                                    <button wire:click="updateStatus({{ $appointment->id }}, 'Cancelled')" class="text-slate-400 hover:text-red-500 transition-colors p-2 rounded-xl hover:bg-red-50">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="p-10 border-t border-slate-50">
            {{ $appointments->links() }}
        </div>
    </div>
</div>
