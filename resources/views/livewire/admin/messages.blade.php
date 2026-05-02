<div class="p-6 md:p-10">
    <div class="flex justify-between items-center mb-10">
        <div>
            <h1 class="text-3xl font-black">Customer Enquiries</h1>
            <p class="text-slate-500 font-medium">Read and manage inquiries from your customers.</p>
        </div>
    </div>

    @if(session()->has('message'))
        <div class="mb-8 bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 px-6 py-4 rounded-2xl font-bold text-sm">
            {{ session('message') }}
        </div>
    @endif

    <div class="glass rounded-[40px] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50/50 text-slate-400 text-[10px] font-black uppercase tracking-widest">
                    <tr>
                        <th class="px-8 py-5">Sender</th>
                        <th class="px-8 py-5">Message</th>
                        <th class="px-8 py-5">Date</th>
                        <th class="px-8 py-5 text-center">Status</th>
                        <th class="px-8 py-5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($messages as $msg)
                    <tr class="hover:bg-slate-50/30 transition-colors {{ !$msg->is_read ? 'bg-indigo-50/20' : '' }}">
                        <td class="px-8 py-6">
                            <div class="font-bold text-slate-900">{{ $msg->name }}</div>
                            <div class="text-xs text-slate-500 font-medium">{{ $msg->email }}</div>
                        </td>
                        <td class="px-8 py-6">
                            <p class="text-sm text-slate-600 line-clamp-2 max-w-md">{{ $msg->message }}</p>
                        </td>
                        <td class="px-8 py-6 text-xs text-slate-500 font-medium">
                            {{ $msg->created_at->format('d M, Y h:i A') }}
                        </td>
                        <td class="px-8 py-6 text-center">
                            @if(!$msg->is_read)
                                <button wire:click="markAsRead({{ $msg->id }})" class="bg-indigo-100 text-indigo-600 px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest">Mark as Read</button>
                            @else
                                <span class="text-slate-400 text-[10px] font-black uppercase tracking-widest">Read</span>
                            @endif
                        </td>
                        <td class="px-8 py-6 text-right">
                            <button wire:click="deleteMessage({{ $msg->id }})" class="text-red-500 hover:text-red-700 bg-red-50 p-2 rounded-xl transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-8 border-t border-slate-50">
            {{ $messages->links() }}
        </div>
    </div>
</div>
