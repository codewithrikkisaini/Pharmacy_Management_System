<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Doctor;
use App\Models\Appointment;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Doctors extends Component
{
    use WithPagination;

    public $search = '';
    public $isBookingModalOpen = false;
    public $selectedDoctor;
    public $patient_name;
    public $appointment_date;
    public $appointment_time;

    public function openBookingModal($doctorId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $this->selectedDoctor = Doctor::find($doctorId);
        $this->patient_name = Auth::user()->name; // Pre-fill with logged in user's name
        $this->isBookingModalOpen = true;
    }

    public function saveAppointment()
    {
        $this->validate([
            'patient_name' => 'required|string|max:255',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',
        ]);

        Appointment::create([
            'user_id' => Auth::id(),
            'doctor_id' => $this->selectedDoctor->id,
            'appointment_date' => $this->appointment_date . ' ' . $this->appointment_time,
            'message' => 'Patient: ' . $this->patient_name, // Storing patient name in message field for now
            'status' => 'Pending',
        ]);

        $this->isBookingModalOpen = false;
        $this->reset(['appointment_date', 'appointment_time', 'patient_name']);
        session()->flash('success', 'Appointment booked successfully! Admin will review it.');
    }

    public function render()
    {
        $doctors = Doctor::query()
            ->when($this->search, fn($q) => $q->where('name', 'like', '%'.$this->search.'%')
                                           ->orWhere('specialization', 'like', '%'.$this->search.'%'))
            ->where('status', true)
            ->latest()
            ->paginate(8);

        return view('livewire.doctors', [
            'doctors' => $doctors,
        ])->layout('layouts.app');
    }
}
