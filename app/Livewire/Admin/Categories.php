<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithFileUploads, WithPagination;

    public $name, $description, $image, $category_id;
    public $isModalOpen = false;
    public $search = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
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
        $this->description = '';
        $this->image = null;
        $this->category_id = null;
    }

    public function save()
    {
        $this->validate();

        $imagePath = $this->image ? $this->image->store('categories', 'public') : null;

        Category::updateOrCreate(['id' => $this->category_id], [
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'description' => $this->description,
            'image' => $imagePath ?? ($this->category_id ? Category::find($this->category_id)->image : null),
        ]);

        session()->flash('message', $this->category_id ? 'Category Updated.' : 'Category Created.');
        $this->closeModal();
        $this->resetFields();
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $this->category_id = $category->id;
        $this->name = $category->name;
        $this->description = $category->description;
        $this->isModalOpen = true;
    }

    public function delete($id)
    {
        Category::find($id)->delete();
        session()->flash('message', 'Category Deleted.');
    }

    public function render()
    {
        $categories = Category::where('name', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        return view('livewire.admin.categories', [
            'categories' => $categories
        ])->layout('layouts.admin');
    }
}
