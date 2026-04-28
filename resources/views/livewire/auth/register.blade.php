<div class="min-h-screen flex items-center justify-center py-20 px-4">
    <div class="glass max-w-md w-full p-10 rounded-[40px] shadow-2xl space-y-8">
        <div class="text-center space-y-2">
            <h2 class="text-3xl font-black text-indigo-600">Join MediCare</h2>
            <p class="text-slate-500">Create an account to start ordering.</p>
        </div>

        <form wire:submit.prevent="register" class="space-y-6">
            <div>
                <label class="block text-sm font-bold mb-2">Full Name</label>
                <input type="text" wire:model="name" class="w-full bg-slate-50 dark:bg-slate-800 border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-indigo-500" placeholder="John Doe">
                @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-bold mb-2">Email Address</label>
                <input type="email" wire:model="email" class="w-full bg-slate-50 dark:bg-slate-800 border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-indigo-500" placeholder="john@example.com">
                @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-bold mb-2">Password</label>
                <input type="password" wire:model="password" class="w-full bg-slate-50 dark:bg-slate-800 border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-indigo-500" placeholder="••••••••">
                @error('password') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-bold mb-2">Confirm Password</label>
                <input type="password" wire:model="password_confirmation" class="w-full bg-slate-50 dark:bg-slate-800 border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-indigo-500" placeholder="••••••••">
            </div>

            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-black py-5 rounded-2xl shadow-xl shadow-indigo-200 dark:shadow-none transition-all transform hover:scale-[1.02]">
                Create Account
            </button>
        </form>

        <div class="text-center text-sm text-slate-500">
            Already have an account? <a href="{{ route('login') }}" class="text-indigo-600 font-bold">Login</a>
        </div>
    </div>
</div>
