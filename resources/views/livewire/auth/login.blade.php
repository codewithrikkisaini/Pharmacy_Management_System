<div class="min-h-screen flex items-center justify-center py-20 px-4">
    <div class="glass max-w-md w-full p-10 rounded-[40px] shadow-2xl space-y-8">
        <div class="text-center space-y-2">
            <h2 class="text-3xl font-black text-indigo-600">MediCare Login</h2>
            <p class="text-slate-500">Welcome back! Please enter your details.</p>
        </div>

        <form wire:submit.prevent="login" class="space-y-6">
            <div>
                <label class="block text-sm font-bold mb-2">Email Address</label>
                <input type="email" wire:model="email" class="w-full bg-slate-50 dark:bg-slate-800 border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-indigo-500" placeholder="admin@medicare.com">
                @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-bold mb-2">Password</label>
                <input type="password" wire:model="password" class="w-full bg-slate-50 dark:bg-slate-800 border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-indigo-500" placeholder="••••••••">
                @error('password') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input type="checkbox" wire:model="remember" class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                    <span class="text-sm text-slate-500 font-medium">Remember me</span>
                </label>
            </div>

            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-black py-5 rounded-2xl shadow-xl shadow-indigo-200 dark:shadow-none transition-all transform hover:scale-[1.02]">
                Login to Dashboard
            </button>
        </form>

        <div class="text-center text-sm text-slate-500">
            Don't have an account? <a href="#" class="text-indigo-600 font-bold">Register</a>
        </div>
    </div>
</div>
