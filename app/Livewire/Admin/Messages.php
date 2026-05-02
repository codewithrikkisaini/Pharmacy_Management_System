<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\ContactMessage;
use Livewire\WithPagination;

class Messages extends Component
{
    use WithPagination;

    public function markAsRead($id)
    {
        $message = ContactMessage::find($id);
        if ($message) {
            $message->update(['is_read' => true]);
        }
    }

    public function deleteMessage($id)
    {
        ContactMessage::find($id)->delete();
        session()->flash('message', 'Message deleted successfully.');
    }

    public function render()
    {
        $messages = ContactMessage::latest()->paginate(10);

        return view('livewire.admin.messages', [
            'messages' => $messages
        ])->layout('layouts.admin');
    }
}
