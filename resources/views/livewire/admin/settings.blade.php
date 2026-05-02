<div class="p-6 md:p-10">
    <div class="mb-10">
        <h1 class="text-3xl font-black">Global Settings</h1>
        <p class="text-slate-500 font-medium">Configure your store branding and contact information.</p>
    </div>

    @if(session()->has('message'))
        <div class="mb-8 bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 px-6 py-4 rounded-2xl font-bold text-sm">
            {{ session('message') }}
        </div>
    @endif

    <div class="max-w-4xl glass rounded-[40px] p-10">
        <form wire:submit.prevent="save" class="space-y-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <div class="space-y-6">
                    <h3 class="text-sm font-black text-emerald-500 uppercase tracking-widest">Site Branding</h3>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-1">Site Name</label>
                        <input type="text" wire:model="site_name" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold text-sm">
                    </div>
                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-1">Site Logo</label>
                        @if($site_logo)
                            <div class="w-32 h-32 bg-slate-100 rounded-3xl overflow-hidden mb-4">
                                <img src="{{ asset('storage/'.$site_logo) }}" class="w-full h-full object-contain">
                            </div>
                        @endif
                        <input type="file" wire:model="new_logo" class="w-full text-xs text-slate-400">
                    </div>
                </div>

                <div class="space-y-6">
                    <h3 class="text-sm font-black text-emerald-500 uppercase tracking-widest">Contact Details</h3>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-1">Email Address</label>
                        <input type="email" wire:model="site_email" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold text-sm">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-1">Phone Number</label>
                        <input type="text" wire:model="site_phone" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold text-sm">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-1">Office Address</label>
                        <textarea wire:model="site_address" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold text-sm h-32"></textarea>
                    </div>
                </div>
            </div>

            <div class="pt-10 border-t flex justify-end">
                <button type="submit" class="bg-emerald-600 text-white px-10 py-4 rounded-2xl font-black text-sm shadow-xl shadow-emerald-200">
                    Update All Settings
                </button>
            </div>
        </form>
    </div>
</div>
