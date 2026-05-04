<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ContactMessage;

class Contact extends Component
{
    public $name;
    public $email;
    public $subject;
    public $message;

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'subject' => 'required|min:5',
        'message' => 'required|min:10',
    ];

    public function sendMessage()
    {
        $this->validate();

        ContactMessage::create([
            'name' => $this->name,
            'email' => $this->email,
            'subject' => $this->subject,
            'message' => $this->message,
            'status' => 'new'
        ]);

        session()->flash('success', 'Your message has been sent successfully! We will contact you soon.');
        
        $this->reset(['name', 'email', 'subject', 'message']);
    }

    public function render()
    {
        return view('livewire.contact')->layout('layouts.app');
    }
}
