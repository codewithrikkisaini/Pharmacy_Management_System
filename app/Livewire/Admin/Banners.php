<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Banner;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Banners extends Component
{
    use WithFileUploads, WithPagination;

    public $title, $subtitle, $link, $image, $banner_id;
    public $status = true;
    public $order = 0;
    public $isModalOpen = false;

    protected $rules = [
        'title' => 'required|string|max:255',
        'subtitle' => 'nullable|string|max:255',
        'image' => 'nullable|image|max:2048',
        'link' => 'nullable|string',
        'status' => 'boolean',
        'order' => 'integer',
    ];

    public function openModal()
    {
        $this->resetFields();
        $this->isModalOpen = true;
    }

    public function resetFields()
    {
        $this->title = '';
        $this->subtitle = '';
        $this->image = null;
        $this->link = '';
        $this->status = true;
        $this->order = 0;
        $this->banner_id = null;
    }

    public function save()
    {
        $this->validate();

        $imagePath = $this->image ? $this->image->store('banners', 'public') : null;

        Banner::updateOrCreate(['id' => $this->banner_id], [
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'image' => $imagePath ?? ($this->banner_id ? Banner::find($this->banner_id)->image : ''),
            'link' => $this->link,
            'status' => $this->status,
            'order' => $this->order,
        ]);

        session()->flash('message', $this->banner_id ? 'Banner Updated.' : 'Banner Created.');
        $this->isModalOpen = false;
        $this->resetFields();
    }

    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        $this->banner_id = $banner->id;
        $this->title = $banner->title;
        $this->subtitle = $banner->subtitle;
        $this->link = $banner->link;
        $this->status = $banner->status;
        $this->order = $banner->order;
        $this->isModalOpen = true;
    }

    public function delete($id)
    {
        Banner::find($id)->delete();
        session()->flash('message', 'Banner Deleted.');
    }

    public function render()
    {
        return view('livewire.admin.banners', [
            'banners' => Banner::orderBy('order')->paginate(10)
        ])->layout('layouts.admin');
    }
}
