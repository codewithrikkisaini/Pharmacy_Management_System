<div class="space-y-8">
    <div>
        <h2 class="text-3xl font-black text-slate-900 tracking-tight">General Settings</h2>
        <p class="text-sm font-medium text-slate-500 mt-1">Configure your pharmacy's identity and contact information.</p>
    </div>

    @if (session()->has('message'))
        <div class="bg-emerald-50 border border-emerald-100 text-emerald-700 px-6 py-4 rounded-2xl flex items-center shadow-sm">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            <span class="font-bold text-sm">{{ session('message') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <div class="bg-white rounded-[40px] shadow-sm border border-slate-50 overflow-hidden">
                <form wire:submit.prevent="save" class="p-10 space-y-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 px-2">Site Name</label>
                            <input type="text" wire:model="site_name" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 px-2">Site Email</label>
                            <input type="email" wire:model="site_email" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 px-2">Site Phone</label>
                            <input type="text" wire:model="site_phone" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 px-2">Footer Copyright Text</label>
                            <input type="text" wire:model="footer_text" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 px-2">Physical Address</label>
                        <textarea wire:model="site_address" rows="3" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500"></textarea>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 px-2">Short Description (SEO)</label>
                        <textarea wire:model="site_description" rows="4" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500"></textarea>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-12 py-5 rounded-2xl font-black shadow-xl shadow-emerald-100 transition-all flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Save Settings
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div>
            <div class="bg-white rounded-[40px] shadow-sm border border-slate-50 p-10 space-y-8">
                <div>
                    <h3 class="text-xl font-black text-slate-900">Brand Assets</h3>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Logo and Favicon</p>
                </div>

                <div class="space-y-6">
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4">Site Logo</label>
                        <div class="flex flex-col items-center p-8 border-2 border-dashed border-slate-200 rounded-3xl space-y-4">
                            @if ($new_logo)
                                <img src="{{ $new_logo->temporaryUrl() }}" class="max-h-20 w-auto rounded-lg shadow-sm">
                            @elseif($site_logo)
                                <img src="{{ Storage::url($site_logo) }}" class="max-h-20 w-auto rounded-lg">
                            @else
                                <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-300">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                            
                            <label class="cursor-pointer bg-slate-900 hover:bg-slate-800 text-white px-6 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">
                                Upload Logo
                                <input type="file" wire:model="new_logo" class="hidden">
                            </label>
                        </div>
                        @error('new_logo') <span class="text-red-500 text-xs font-bold mt-2 block">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
