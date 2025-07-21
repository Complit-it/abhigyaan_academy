<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PublicMenu extends Component
{

    public function onHomeClick()
    {
        return view('livewire.home-page');
    }
    public function onContactClick()
    {
        return view('livewire.contact-us');
    }
    public function render()
    {
        return view('livewire.public-menu');
    }
}
