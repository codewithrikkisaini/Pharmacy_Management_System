<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Setting;
use Livewire\WithFileUploads;

class Settings extends Component
{
    use WithFileUploads;

    public $site_name, $site_email, $site_phone, $site_address, $site_logo;
    public $new_logo;

    public function mount()
    {
        $this->site_name = Setting::where('key', 'site_name')->first()?->value ?? 'MediCare';
        $this->site_email = Setting::where('key', 'site_email')->first()?->value ?? 'support@medicare.com';
        $this->site_phone = Setting::where('key', 'site_phone')->first()?->value ?? '+1 (555) 123-4567';
        $this->site_address = Setting::where('key', 'site_address')->first()?->value ?? '123 Medical Ave, Health City';
        $this->site_logo = Setting::where('key', 'site_logo')->first()?->value;
    }

    public function save()
    {
        Setting::updateOrCreate(['key' => 'site_name'], ['value' => $this->site_name]);
        Setting::updateOrCreate(['key' => 'site_email'], ['value' => $this->site_email]);
        Setting::updateOrCreate(['key' => 'site_phone'], ['value' => $this->site_phone]);
        Setting::updateOrCreate(['key' => 'site_address'], ['value' => $this->site_address]);

        if ($this->new_logo) {
            $logoPath = $this->new_logo->store('settings', 'public');
            Setting::updateOrCreate(['key' => 'site_logo'], ['value' => $logoPath]);
            $this->site_logo = $logoPath;
        }

        session()->flash('message', 'Settings updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.settings')->layout('layouts.admin');
    }
}
