<?php

namespace App\Livewire\Main;

use Livewire\Component;

class HomeComponent extends Component
{
    public function render()
    {
        return view('livewire.main.home-component')->layout('layouts.'.Subdomain());
    }
}
