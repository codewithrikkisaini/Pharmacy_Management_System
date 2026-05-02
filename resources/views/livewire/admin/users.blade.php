<div class="p-6 md:p-10">
    <div class="flex justify-between items-center mb-10">
        <div>
            <h1 class="text-3xl font-black">Users Management</h1>
            <p class="text-slate-500 font-medium">Manage administrators and customers.</p>
        </div>
    </div>

    <div class="glass rounded-[40px] overflow-hidden">
        <div class="p-8 border-b flex flex-col md:flex-row gap-6 justify-between items-center">
            <div class="relative w-full md:w-96">
                <input type="text" wire:model.live="search" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold focus:ring-2 focus:ring-indigo-500" placeholder="Search users...">
            </div>
            <div class="flex gap-4 w-full md:w-auto">
                <select wire:model.live="role" class="bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold focus:ring-2 focus:ring-indigo-500">
                    <option value="">All Roles</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left border-b bg-slate-50/50">
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">User</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Email</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Role</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Joined</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach($users as $user)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-black">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <span class="font-bold">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="px-8 py-6 font-medium text-slate-500">{{ $user->email }}</td>
                        <td class="px-8 py-6">
                            <span class="inline-block px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest {{ $user->role == 'admin' ? 'bg-indigo-100 text-indigo-600' : 'bg-slate-100 text-slate-600' }}">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td class="px-8 py-6 font-medium text-slate-500">{{ $user->created_at->format('M d, Y') }}</td>
                        <td class="px-8 py-6 text-right">
                            @if($user->id !== auth()->id())
                            <button wire:click="deleteUser({{ $user->id }})" wire:confirm="Are you sure you want to delete this user?" class="text-red-500 hover:text-red-700 font-bold text-xs">Delete</button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="p-8 border-t">
            {{ $users->links() }}
        </div>
    </div>
</div>
