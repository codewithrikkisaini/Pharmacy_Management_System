<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Appointment;
use Livewire\WithPagination;

class Appointments extends Component
{
    use WithPagination;

    public $search = '';

    public function updateStatus($appointmentId, $status)
    {
        $appointment = Appointment::find($appointmentId);
        if ($appointment) {
            $appointment->update(['status' => $status]);
            session()->flash('message', 'Appointment status updated to ' . $status);
        }
    }

    public function render()
    {
        $appointments = Appointment::with(['user', 'doctor'])
            ->whereHas('user', function($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);

        return view('livewire.admin.appointments', [
            'appointments' => $appointments
        ])->layout('layouts.admin');
    }
}
