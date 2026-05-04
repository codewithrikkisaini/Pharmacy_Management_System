<div class="min-h-screen flex items-center justify-center bg-slate-50 py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    <!-- Decorative background elements -->
    <div class="absolute top-0 right-0 -mr-32 -mt-32 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-0 -ml-32 -mb-32 w-96 h-96 bg-emerald-600/10 rounded-full blur-3xl"></div>

    <div class="max-w-md w-full space-y-8 glass p-12 rounded-[60px] shadow-2xl shadow-emerald-100 border border-white relative z-10">
        <div class="text-center space-y-4">
            <div class="mx-auto w-20 h-20 bg-emerald-600 rounded-3xl flex items-center justify-center text-white shadow-xl shadow-emerald-200">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
            </div>
            <h2 class="text-4xl font-black text-slate-900 tracking-tight">Create <span class="text-emerald-600">Account</span></h2>
            <p class="text-slate-400 font-bold text-sm uppercase tracking-widest">Join our community for better healthcare</p>
        </div>

        <form wire:submit.prevent="register" class="mt-8 space-y-8">
            <div class="space-y-6">
                <div class="space-y-3">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Full Name</label>
                    <input wire:model="name" type="text" required class="w-full bg-slate-50 border-none rounded-2xl px-6 py-5 font-bold text-sm focus:ring-2 focus:ring-emerald-500 transition-all placeholder-slate-300" placeholder="John Doe">
                    @error('name') <span class="text-red-500 text-[10px] font-black px-2 uppercase tracking-widest">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-3">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Email Address</label>
                    <input wire:model="email" type="email" required class="w-full bg-slate-50 border-none rounded-2xl px-6 py-5 font-bold text-sm focus:ring-2 focus:ring-emerald-500 transition-all placeholder-slate-300" placeholder="name@example.com">
                    @error('email') <span class="text-red-500 text-[10px] font-black px-2 uppercase tracking-widest">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Password</label>
                        <input wire:model="password" type="password" required class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold text-sm focus:ring-2 focus:ring-emerald-500 transition-all placeholder-slate-300" placeholder="••••••••">
                        @error('password') <span class="text-red-500 text-[10px] font-black px-2 uppercase tracking-widest">{{ $message }}</span> @enderror
                    </div>
                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Confirm</label>
                        <input wire:model="password_confirmation" type="password" required class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold text-sm focus:ring-2 focus:ring-emerald-500 transition-all placeholder-slate-300" placeholder="••••••••">
                    </div>
                </div>
            </div>

            <div class="px-2">
                <label class="flex items-center gap-3 cursor-pointer group">
                    <input type="checkbox" required class="w-5 h-5 rounded-lg border-slate-200 text-emerald-600 focus:ring-emerald-500">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest group-hover:text-slate-600 transition-colors">I agree to the Terms & Conditions</span>
                </label>
            </div>

            <div>
                <button type="submit" class="w-full bg-emerald-600 text-white py-6 rounded-3xl font-black text-sm uppercase tracking-[0.2em] shadow-2xl shadow-emerald-100 hover:bg-emerald-700 hover:-translate-y-1 transition-all duration-300">
                    Create Account
                </button>
            </div>
        </form>

        <div class="pt-10 text-center">
            <p class="text-xs font-bold text-slate-400">Already have an account? <a href="{{ route('login') }}" class="text-emerald-600 font-black hover:underline ml-2">Login Now</a></p>
        </div>
    </div>
</div>
