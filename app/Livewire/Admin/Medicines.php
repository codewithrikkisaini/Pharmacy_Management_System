<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Medicine;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Medicines extends Component
{
    use WithFileUploads, WithPagination;

    public $name, $category_id, $description, $price, $stock, $expiry_date, $image, $type, $medicine_id;
    public $isModalOpen = false;
    public $search = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'image' => 'nullable|image|max:1024',
        'type' => 'required|string',
        'expiry_date' => 'nullable|date',
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
        $this->category_id = '';
        $this->description = '';
        $this->price = '';
        $this->stock = '';
        $this->expiry_date = '';
        $this->image = null;
        $this->type = '';
        $this->medicine_id = null;
    }

    public function save()
    {
        $this->validate();

        $imagePath = $this->image ? $this->image->store('medicines', 'public') : null;

        Medicine::updateOrCreate(['id' => $this->medicine_id], [
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'category_id' => $this->category_id,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'expiry_date' => $this->expiry_date,
            'image' => $imagePath ?? ($this->medicine_id ? Medicine::find($this->medicine_id)->image : null),
            'type' => $this->type,
        ]);

        session()->flash('message', $this->medicine_id ? 'Medicine Updated.' : 'Medicine Created.');
        $this->closeModal();
        $this->resetFields();
    }

    public function edit($id)
    {
        $medicine = Medicine::findOrFail($id);
        $this->medicine_id = $medicine->id;
        $this->name = $medicine->name;
        $this->category_id = $medicine->category_id;
        $this->description = $medicine->description;
        $this->price = $medicine->price;
        $this->stock = $medicine->stock;
        $this->type = $medicine->type;
        $this->expiry_date = $medicine->expiry_date;
        $this->isModalOpen = true;
    }

    public function delete($id)
    {
        Medicine::find($id)->delete();
        session()->flash('message', 'Medicine Deleted.');
    }

    public function render()
    {
        $medicines = Medicine::with('category')
            ->where('name', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        return view('livewire.admin.medicines', [
            'medicines' => $medicines,
            'categories' => Category::all()
        ])->layout('layouts.admin');
    }
}
