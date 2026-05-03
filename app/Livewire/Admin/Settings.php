<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Setting;
use Livewire\WithFileUploads;

class Settings extends Component
{
    use WithFileUploads;

    public $site_name;
    public $site_email;
    public $site_phone;
    public $site_address;
    public $site_description;
    public $footer_text;
    public $site_logo;
    public $new_logo;

    public function mount()
    {
        $this->site_name = Setting::get('site_name', 'MediCare');
        $this->site_email = Setting::get('site_email', 'support@medicare.com');
        $this->site_phone = Setting::get('site_phone', '+1 (555) 123-4567');
        $this->site_address = Setting::get('site_address', '123 Medical Plaza, Health City');
        $this->site_description = Setting::get('site_description', '');
        $this->footer_text = Setting::get('footer_text', 'MediCare – All rights reserved.');
        $this->site_logo = Setting::get('site_logo');
    }

    public function save()
    {
        Setting::set('site_name', $this->site_name);
        Setting::set('site_email', $this->site_email);
        Setting::set('site_phone', $this->site_phone);
        Setting::set('site_address', $this->site_address);
        Setting::set('site_description', $this->site_description);
        Setting::set('footer_text', $this->footer_text);

        if ($this->new_logo) {
            $logoPath = $this->new_logo->store('settings', 'public');
            Setting::set('site_logo', $logoPath);
            $this->site_logo = $logoPath;
        }

        session()->flash('message', 'Settings updated successfully!');
    }

    public function render()
    {
        return view('livewire.admin.settings')->layout('layouts.admin');
    }
}
