<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h2 class="text-3xl font-bold tracking-tight">Doctors</h2>
        <button wire:click="openModal" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-2xl font-bold transition-all shadow-lg shadow-emerald-200 dark:shadow-none">
            Add Doctor
        </button>
    </div>

    @if (session()->has('message'))
        <div class="bg-emerald-100 border border-emerald-200 text-emerald-700 px-6 py-4 rounded-2xl">
            {{ session('message') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($doctors as $doctor)
        <div class="glass p-6 rounded-3xl space-y-4">
            <div class="flex items-center space-x-4">
                <img src="{{ $doctor->image ? asset('storage/'.$doctor->image) : 'https://ui-avatars.com/api/?name='.urlencode($doctor->name).'&color=10b981&background=ecfdf5' }}" class="w-16 h-16 rounded-2xl object-cover shadow-md">
                <div>
                    <h3 class="font-bold text-lg">{{ $doctor->name }}</h3>
                    <p class="text-sm text-emerald-600 font-medium">{{ $doctor->specialization }}</p>
                </div>
            </div>
            <div class="text-sm text-slate-500">
                <span class="font-bold">Experience:</span> {{ $doctor->experience }}
            </div>
            <div class="pt-4 flex space-x-2">
                <button wire:click="edit({{ $doctor->id }})" class="flex-1 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 font-bold py-2 rounded-xl transition-all">Edit</button>
                <button onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" wire:click="delete({{ $doctor->id }})" class="flex-1 bg-red-50 text-red-600 hover:bg-red-100 font-bold py-2 rounded-xl transition-all">Delete</button>
            </div>
        </div>
        @endforeach
    </div>
    
    <div class="mt-8">
        {{ $doctors->links() }}
    </div>

    <!-- Modal -->
    @if($isModalOpen)
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm">
        <div class="glass w-full max-w-lg rounded-3xl shadow-2xl overflow-hidden">
            <div class="p-8 border-b flex justify-between items-center">
                <h3 class="text-xl font-bold">{{ $doctor_id ? 'Edit Doctor' : 'Add Doctor' }}</h3>
                <button wire:click="closeModal" class="text-slate-400 hover:text-slate-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <form wire:submit.prevent="save" class="p-8 space-y-6">
                <div>
                    <label class="block text-sm font-bold mb-2">Full Name</label>
                    <input type="text" wire:model="name" class="w-full bg-slate-50 dark:bg-slate-800 border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500">
                    @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-bold mb-2">Specialization</label>
                    <input type="text" wire:model="specialization" class="w-full bg-slate-50 dark:bg-slate-800 border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500" placeholder="e.g. Cardiologist">
                    @error('specialization') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-bold mb-2">Experience</label>
                    <input type="text" wire:model="experience" class="w-full bg-slate-50 dark:bg-slate-800 border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500" placeholder="e.g. 10 Years">
                    @error('experience') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-bold mb-2">Profile Image</label>
                    <div class="flex items-center gap-4 mb-4">
                        @if ($image)
                            <img src="{{ $image->temporaryUrl() }}" class="w-20 h-20 rounded-2xl object-cover shadow-lg border-2 border-emerald-500">
                        @elseif($doctor_id && ($old_doctor = \App\Models\Doctor::find($doctor_id)) && $old_doctor->image)
                            <img src="{{ asset('storage/'.$old_doctor->image) }}" class="w-20 h-20 rounded-2xl object-cover shadow-lg">
                        @endif
                        <input type="file" wire:model="image" class="text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                    </div>
                    @error('image') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="pt-4">
                    <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-4 rounded-2xl shadow-lg shadow-emerald-200 dark:shadow-none transition-all">
                        {{ $doctor_id ? 'Update Doctor' : 'Save Doctor' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>

