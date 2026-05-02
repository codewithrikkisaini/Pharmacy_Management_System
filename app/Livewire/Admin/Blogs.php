<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Blog;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Blogs extends Component
{
    use WithFileUploads, WithPagination;

    public $title, $content, $image, $blog_id;
    public $status = true;
    public $isModalOpen = false;
    public $search = '';

    protected $rules = [
        'title' => 'required|string|max:255',
        'content' => 'required',
        'image' => 'nullable|image|max:2048',
        'status' => 'boolean',
    ];

    public function openModal()
    {
        $this->resetFields();
        $this->isModalOpen = true;
    }

    public function resetFields()
    {
        $this->title = '';
        $this->content = '';
        $this->image = null;
        $this->status = true;
        $this->blog_id = null;
    }

    public function save()
    {
        $this->validate();

        $imagePath = $this->image ? $this->image->store('blogs', 'public') : null;

        Blog::updateOrCreate(['id' => $this->blog_id], [
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'content' => $this->content,
            'image' => $imagePath ?? ($this->blog_id ? Blog::find($this->blog_id)->image : ''),
            'status' => $this->status,
            'user_id' => auth()->id(),
        ]);

        session()->flash('message', $this->blog_id ? 'Blog Updated.' : 'Blog Created.');
        $this->isModalOpen = false;
        $this->resetFields();
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        $this->blog_id = $blog->id;
        $this->title = $blog->title;
        $this->content = $blog->content;
        $this->status = $blog->status;
        $this->isModalOpen = true;
    }

    public function delete($id)
    {
        Blog::find($id)->delete();
        session()->flash('message', 'Blog Deleted.');
    }

    public function render()
    {
        return view('livewire.admin.blogs', [
            'blogs' => Blog::where('title', 'like', '%'.$this->search.'%')->latest()->paginate(10)
        ])->layout('layouts.admin');
    }
}
