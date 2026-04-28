<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Medicine;
use App\Models\Category;
use Livewire\WithPagination;

class Medicines extends Component
{
    use WithPagination;

    public $search = '';
    public $category_id = '';
    public $type = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $medicines = Medicine::query()
            ->when($this->search, fn($q) => $q->where('name', 'like', '%'.$this->search.'%'))
            ->when($this->category_id, fn($q) => $q->where('category_id', $this->category_id))
            ->when($this->type, fn($q) => $q->where('type', $this->type))
            ->latest()
            ->paginate(12);

        return view('livewire.medicines', [
            'medicines' => $medicines,
            'categories' => Category::all(),
        ])->layout('layouts.app');
    }
}
