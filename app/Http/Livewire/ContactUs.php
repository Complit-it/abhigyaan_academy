<?php

namespace App\Http\Livewire;

use Livewire\Component;

//define Route

class ContactUs extends Component
{
    public function render()
    {

        return view('livewire.contact-us',
            [
                'title' => 'Contact Us',
            ]);
    }
}
