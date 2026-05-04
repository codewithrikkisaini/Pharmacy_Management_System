<div class="py-24 bg-slate-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="space-y-4 mb-16">
            <span class="bg-emerald-100 text-emerald-600 px-4 py-2 rounded-full text-[10px] font-black uppercase tracking-widest">Account Settings</span>
            <h1 class="text-5xl font-black text-slate-900 tracking-tight">Your <span class="text-emerald-600">Profile</span></h1>
            <p class="text-slate-500 font-medium">Manage your personal information and security settings.</p>
        </div>

        @if(session()->has('success'))
            <div class="mb-10 bg-emerald-500 text-white px-8 py-5 rounded-3xl font-black text-sm shadow-xl animate-bounce">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 gap-10">
            <!-- Profile Info -->
            <div class="bg-white p-12 rounded-[50px] shadow-xl shadow-slate-200/50 border border-white">
                <h3 class="text-2xl font-black text-slate-900 mb-10 flex items-center gap-4">
                    <div class="w-10 h-10 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    Personal Information
                </h3>

                <form wire:submit.prevent="updateProfile" class="space-y-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-3">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Full Name</label>
                            <input type="text" wire:model="name" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold text-sm focus:ring-2 focus:ring-emerald-500 transition-all">
                            @error('name') <span class="text-red-500 text-[10px] font-black px-2">{{ $message }}</span> @enderror
                        </div>
                        <div class="space-y-3">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Email Address</label>
                            <input type="email" wire:model="email" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold text-sm focus:ring-2 focus:ring-emerald-500 transition-all">
                            @error('email') <span class="text-red-500 text-[10px] font-black px-2">{{ $message }}</span> @enderror
                        </div>
                        <div class="space-y-3">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Phone Number</label>
                            <input type="text" wire:model="phone" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold text-sm focus:ring-2 focus:ring-emerald-500 transition-all">
                            @error('phone') <span class="text-red-500 text-[10px] font-black px-2">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Shipping Address</label>
                        <textarea wire:model="address" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold text-sm focus:ring-2 focus:ring-emerald-500 transition-all h-32"></textarea>
                        @error('address') <span class="text-red-500 text-[10px] font-black px-2">{{ $message }}</span> @enderror
                    </div>

                    <div class="pt-6">
                        <button type="submit" class="bg-emerald-600 text-white px-12 py-5 rounded-2xl font-black shadow-xl shadow-emerald-100 hover:bg-emerald-700 transition-all uppercase tracking-widest text-xs">
                            Update Profile
                        </button>
                    </div>
                </form>
            </div>

            <!-- Password Update -->
            <div class="bg-white p-12 rounded-[50px] shadow-xl shadow-slate-200/50 border border-white">
                <h3 class="text-2xl font-black text-slate-900 mb-10 flex items-center gap-4">
                    <div class="w-10 h-10 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    Security & Password
                </h3>

                <form wire:submit.prevent="updatePassword" class="space-y-8">
                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Current Password</label>
                        <input type="password" wire:model="current_password" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold text-sm focus:ring-2 focus:ring-emerald-500 transition-all">
                        @error('current_password') <span class="text-red-500 text-[10px] font-black px-2">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-3">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">New Password</label>
                            <input type="password" wire:model="new_password" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold text-sm focus:ring-2 focus:ring-emerald-500 transition-all">
                            @error('new_password') <span class="text-red-500 text-[10px] font-black px-2">{{ $message }}</span> @enderror
                        </div>
                        <div class="space-y-3">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Confirm New Password</label>
                            <input type="password" wire:model="new_password_confirmation" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold text-sm focus:ring-2 focus:ring-emerald-500 transition-all">
                        </div>
                    </div>

                    <div class="pt-6">
                        <button type="submit" class="bg-slate-900 text-white px-12 py-5 rounded-2xl font-black shadow-xl shadow-slate-200 hover:bg-emerald-600 transition-all uppercase tracking-widest text-xs">
                            Change Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
