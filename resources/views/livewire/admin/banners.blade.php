<div class="p-6 md:p-10">
    <div class="flex justify-between items-center mb-10">
        <div>
            <h1 class="text-3xl font-black">Hero Banners</h1>
            <p class="text-slate-500 font-medium">Manage images for your homepage slider.</p>
        </div>
        <button wire:click="openModal" class="bg-emerald-600 text-white px-6 py-3 rounded-2xl font-bold text-sm shadow-lg shadow-emerald-200">
            Add New Banner
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($banners as $banner)
        <div class="glass rounded-[32px] overflow-hidden group">
            <div class="h-48 relative overflow-hidden">
                <img src="{{ asset('storage/'.$banner->image) }}" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-4">
                    <button wire:click="edit({{ $banner->id }})" class="p-3 bg-white rounded-xl text-emerald-600 hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    </button>
                    <button wire:click="delete({{ $banner->id }})" class="p-3 bg-white rounded-xl text-red-600 hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                </div>
            </div>
            <div class="p-6">
                <h3 class="font-bold text-lg">{{ $banner->title }}</h3>
                <p class="text-sm text-slate-500 mb-4">{{ $banner->subtitle }}</p>
                <div class="flex items-center justify-between">
                    <span class="text-[10px] font-black uppercase tracking-widest {{ $banner->status ? 'text-emerald-500' : 'text-slate-400' }}">
                        {{ $banner->status ? 'Active' : 'Draft' }}
                    </span>
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Order: {{ $banner->order }}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if($isModalOpen)
    <div class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm">
        <div class="bg-white w-full max-w-md rounded-[40px] p-10 shadow-2xl">
            <h3 class="text-2xl font-black mb-8">{{ $banner_id ? 'Edit Banner' : 'New Banner' }}</h3>
            <form wire:submit.prevent="save" class="space-y-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-1">Title</label>
                    <input type="text" wire:model="title" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold text-sm">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-1">Subtitle</label>
                    <input type="text" wire:model="subtitle" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold text-sm">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-1">Banner Image</label>
                    <input type="file" wire:model="image" class="w-full">
                </div>
                <div class="flex gap-4">
                    <button type="submit" class="flex-1 bg-emerald-600 text-white font-black py-4 rounded-2xl">Save Banner</button>
                    <button type="button" wire:click="$set('isModalOpen', false)" class="flex-1 bg-slate-100 text-slate-600 font-black py-4 rounded-2xl">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
