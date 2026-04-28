<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Doctor;
use Livewire\WithPagination;

class Doctors extends Component
{
    use WithPagination;

    public $search = '';

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
