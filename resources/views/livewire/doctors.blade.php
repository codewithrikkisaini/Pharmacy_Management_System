<div class="pb-20">
    <!-- Header Section -->
    <div class="bg-emerald-600 pt-32 pb-20 text-white relative overflow-hidden text-center">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-6">
            <span class="bg-white/20 px-4 py-2 rounded-full text-xs font-black uppercase tracking-widest">Medical Team</span>
            <h1 class="text-6xl font-black">Our Specialist Doctors</h1>
            <p class="text-emerald-50 text-lg font-medium leading-relaxed">
                Connect with our highly experienced medical professionals for professional advice and care. Book your appointment in seconds.
            </p>
        </div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-emerald-400/20 rounded-full blur-3xl"></div>
    </div>

    <!-- Content Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10">
        @if(session()->has('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" 
                 x-transition:enter="transition ease-out duration-500"
                 x-transition:enter-start="opacity-0 transform -translate-y-10 scale-95"
                 x-transition:enter-end="opacity-100 transform translate-y-0 scale-100"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="opacity-100 transform translate-y-0 scale-100"
                 x-transition:leave-end="opacity-0 transform -translate-y-10 scale-95"
                 class="fixed top-24 left-1/2 -translate-x-1/2 z-[200] w-full max-w-xl px-4">
                <div class="bg-slate-900 text-white p-6 rounded-[32px] shadow-2xl shadow-emerald-900/20 border border-emerald-500/30 flex items-center gap-6">
                    <div class="w-14 h-14 bg-emerald-500 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-emerald-500/20 shrink-0">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <div>
                        <h4 class="font-black text-lg tracking-tight">Booking Confirmed!</h4>
                        <p class="text-slate-400 text-xs font-bold uppercase tracking-widest">{{ session('success') }}</p>
                    </div>
                    <button @click="show = false" class="ml-auto text-slate-500 hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            </div>
        @endif

        <div class="glass p-8 rounded-[40px] mb-12 flex flex-col md:flex-row items-center justify-between gap-6 shadow-xl border-2 border-emerald-50">
            <div class="relative w-full md:w-96">
                <input type="text" wire:model.live="search" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm focus:ring-2 focus:ring-emerald-500 font-bold" placeholder="Search by name or specialization...">
                <svg class="w-4 h-4 text-slate-400 absolute right-5 top-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <div class="flex items-center space-x-4">
                <span class="text-sm font-bold text-slate-500">Total Doctors: {{ $doctors->total() }}</span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse($doctors as $doctor)
            <div class="glass group rounded-[40px] overflow-hidden hover:shadow-2xl transition-all duration-500 flex flex-col h-full border-2 border-transparent hover:border-emerald-50">
                <div class="h-80 overflow-hidden relative">
                    <img src="{{ $doctor->image ? Storage::url($doctor->image) : 'https://ui-avatars.com/api/?name='.urlencode($doctor->name).'&size=800&color=10b981&background=ecfdf5' }}" 
                         onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($doctor->name) }}&size=800&color=10b981&background=ecfdf5'"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute bottom-6 left-6 right-6 p-4 glass rounded-3xl backdrop-blur-md border border-white/30 translate-y-20 group-hover:translate-y-0 transition-transform duration-500">
                        <div class="text-[10px] font-black text-emerald-600 uppercase tracking-widest mb-1">Availability</div>
                        <div class="text-xs font-bold text-slate-900">Mon - Fri, 09:00 - 17:00</div>
                    </div>
                </div>
                <div class="p-8 space-y-4 flex flex-col flex-1 text-center">
                    <div class="text-[10px] font-black text-emerald-600 uppercase tracking-[0.2em]">{{ $doctor->specialization }}</div>
                    <h3 class="font-black text-2xl text-slate-900">{{ $doctor->name }}</h3>
                    <div class="flex items-center justify-center space-x-2 text-amber-400">
                        @for($i=0; $i<5; $i++)
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        @endfor
                        <span class="text-xs font-bold text-slate-400 ml-2">(4.9)</span>
                    </div>
                    
                    <div class="pt-6 mt-auto">
                        <button wire:click="openBookingModal({{ $doctor->id }})" class="w-full bg-emerald-600 text-white py-4 rounded-2xl font-black text-sm shadow-xl shadow-emerald-200 dark:shadow-none hover:bg-emerald-700 transition-all">
                            Book Appointment
                        </button>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full py-40 text-center glass rounded-[40px]">
                <h3 class="text-2xl font-black text-slate-900">No doctors found</h3>
                <p class="text-slate-500 font-medium mt-2">Try a different name or specialization.</p>
            </div>
            @endforelse
        </div>

        <div class="mt-16">
            {{ $doctors->links() }}
        </div>
    </div>

    <!-- Booking Modal -->
    @if($isBookingModalOpen)
    <div class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm">
        <div class="bg-white w-full max-w-lg rounded-[40px] shadow-2xl overflow-hidden animate-in fade-in zoom-in duration-300">
            <div class="p-10 border-b border-slate-50 flex justify-between items-center bg-slate-50/30">
                <div>
                    <h3 class="text-2xl font-black text-slate-900 tracking-tight">Book Appointment</h3>
                    <p class="text-[10px] font-black text-emerald-600 uppercase tracking-widest mt-1">With {{ $selectedDoctor->name }}</p>
                </div>
                <button wire:click="$set('isBookingModalOpen', false)" class="text-slate-400 hover:text-slate-900 bg-white p-2 rounded-full shadow-sm transition-all">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <form wire:submit.prevent="saveAppointment" class="p-10 space-y-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Patient Full Name</label>
                    <input type="text" wire:model="patient_name" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold text-sm focus:ring-2 focus:ring-emerald-500 transition-all" placeholder="Enter patient name">
                    @error('patient_name') <span class="text-red-500 text-[10px] font-black px-2 uppercase tracking-widest">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Select Preferred Date</label>
                    <input type="date" wire:model="appointment_date" min="{{ date('Y-m-d') }}" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold text-sm focus:ring-2 focus:ring-emerald-500 transition-all">
                    @error('appointment_date') <span class="text-red-500 text-[10px] font-black px-2 uppercase tracking-widest">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Select Time Slot</label>
                    <select wire:model="appointment_time" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold text-sm focus:ring-2 focus:ring-emerald-500 transition-all">
                        <option value="">Select a time</option>
                        <option value="09:00">09:00 AM</option>
                        <option value="10:00">10:00 AM</option>
                        <option value="11:00">11:00 AM</option>
                        <option value="12:00">12:00 PM</option>
                        <option value="14:00">02:00 PM</option>
                        <option value="15:00">03:00 PM</option>
                        <option value="16:00">04:00 PM</option>
                    </select>
                    @error('appointment_time') <span class="text-red-500 text-[10px] font-black px-2 uppercase tracking-widest">{{ $message }}</span> @enderror
                </div>

                <div class="pt-6">
                    <button type="submit" class="w-full bg-emerald-600 text-white font-black py-5 rounded-2xl shadow-xl shadow-emerald-200 hover:bg-emerald-700 transition-all uppercase tracking-widest text-xs">
                        Confirm Booking
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
