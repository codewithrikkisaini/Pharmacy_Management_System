<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class Register extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ];

    public function register()
    {
        $this->validate();

        $role = ($this->email === 'rikkisaini4455@gmail.com') ? 'admin' : 'user';

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => $role,
        ]);

        Auth::login($user);

        if ($user->role === 'admin' || $user->email === 'rikkisaini4455@gmail.com') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.auth.register')->layout('layouts.app');
    }
}
