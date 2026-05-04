<div class="min-h-screen flex items-center justify-center bg-slate-50 py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    <!-- Decorative background elements -->
    <div class="absolute top-0 right-0 -mr-32 -mt-32 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-0 -ml-32 -mb-32 w-96 h-96 bg-emerald-600/10 rounded-full blur-3xl"></div>

    <div class="max-w-md w-full space-y-8 glass p-12 rounded-[60px] shadow-2xl shadow-emerald-100 border border-white relative z-10">
        <div class="text-center space-y-4">
            <div class="mx-auto w-20 h-20 bg-emerald-600 rounded-3xl flex items-center justify-center text-white shadow-xl shadow-emerald-200">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
            </div>
            <h2 class="text-4xl font-black text-slate-900 tracking-tight">MediCare <span class="text-emerald-600">Login</span></h2>
            <p class="text-slate-400 font-bold text-sm uppercase tracking-widest">Enter your credentials to access your dashboard</p>
        </div>

        <form wire:submit.prevent="login" class="mt-8 space-y-8">
            <div class="space-y-6">
                <div class="space-y-3">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Email Address</label>
                    <div class="relative group">
                        <input wire:model="email" type="email" required class="w-full bg-slate-50 border-none rounded-2xl px-6 py-5 font-bold text-sm focus:ring-2 focus:ring-emerald-500 transition-all placeholder-slate-300" placeholder="name@example.com">
                        <svg class="w-5 h-5 text-slate-300 absolute right-6 top-5 group-hover:text-emerald-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"></path></svg>
                    </div>
                    @error('email') <span class="text-red-500 text-[10px] font-black px-2 uppercase tracking-widest">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-3">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Password</label>
                    <div class="relative group">
                        <input wire:model="password" type="password" required class="w-full bg-slate-50 border-none rounded-2xl px-6 py-5 font-bold text-sm focus:ring-2 focus:ring-emerald-500 transition-all placeholder-slate-300" placeholder="••••••••">
                        <svg class="w-5 h-5 text-slate-300 absolute right-6 top-5 group-hover:text-emerald-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    @error('password') <span class="text-red-500 text-[10px] font-black px-2 uppercase tracking-widest">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex items-center justify-between px-2">
                <label class="flex items-center gap-3 cursor-pointer group">
                    <input type="checkbox" wire:model="remember" class="w-5 h-5 rounded-lg border-slate-200 text-emerald-600 focus:ring-emerald-500">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest group-hover:text-slate-600 transition-colors">Remember me</span>
                </label>
                <a href="#" class="text-[10px] font-black text-emerald-600 uppercase tracking-widest hover:text-emerald-700 transition-colors">Forgot Password?</a>
            </div>

            <div>
                <button type="submit" class="w-full bg-slate-900 text-white py-6 rounded-3xl font-black text-sm uppercase tracking-[0.2em] shadow-2xl shadow-slate-200 hover:bg-emerald-600 hover:-translate-y-1 transition-all duration-300">
                    Login to Dashboard
                </button>
            </div>
        </form>

        <div class="pt-10 text-center">
            <p class="text-xs font-bold text-slate-400">Don't have an account? <a href="{{ route('register') }}" class="text-emerald-600 font-black hover:underline ml-2">Register Now</a></p>
        </div>
    </div>
</div>
