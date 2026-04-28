<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Doctor;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Doctors extends Component
{
    use WithFileUploads, WithPagination;

    public $name, $specialization, $experience, $image, $doctor_id;
    public $isModalOpen = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'specialization' => 'required|string|max:255',
        'experience' => 'required|string|max:255',
        'image' => 'nullable|image|max:1024',
    ];

    public function openModal()
    {
        $this->resetFields();
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    public function resetFields()
    {
        $this->name = '';
        $this->specialization = '';
        $this->experience = '';
        $this->image = null;
        $this->doctor_id = null;
    }

    public function save()
    {
        $this->validate();

        $imagePath = $this->image ? $this->image->store('doctors', 'public') : null;

        Doctor::updateOrCreate(['id' => $this->doctor_id], [
            'name' => $this->name,
            'specialization' => $this->specialization,
            'experience' => $this->experience,
            'image' => $imagePath ?? ($this->doctor_id ? Doctor::find($this->doctor_id)->image : null),
        ]);

        session()->flash('message', $this->doctor_id ? 'Doctor Updated.' : 'Doctor Added.');
        $this->closeModal();
        $this->resetFields();
    }

    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);
        $this->doctor_id = $doctor->id;
        $this->name = $doctor->name;
        $this->specialization = $doctor->specialization;
        $this->experience = $doctor->experience;
        $this->isModalOpen = true;
    }

    public function delete($id)
    {
        Doctor::find($id)->delete();
        session()->flash('message', 'Doctor Deleted.');
    }

    public function render()
    {
        return view('livewire.admin.doctors', [
            'doctors' => Doctor::latest()->paginate(10)
        ])->layout('layouts.admin');
    }
}
