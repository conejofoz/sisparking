<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Caixas extends Component
{
    public $name = 'Silvio';
    
    public function mount(){

    }


    public function render()
    {
        return view('livewire.caixas');
    }
}
