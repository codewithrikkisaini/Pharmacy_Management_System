<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Blog;

class BlogDetail extends Component
{
    public $blog;

    public function mount($slug)
    {
        $this->blog = Blog::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.blog-detail')->layout('layouts.app');
    }
}
