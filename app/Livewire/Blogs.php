<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Blog;
use Livewire\WithPagination;

class Blogs extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.blogs', [
            'blogs' => Blog::where('status', true)->latest()->paginate(9)
        ])->layout('layouts.app');
    }
}
