<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Caixas extends Component
{
    public $name = 'Silvio';

    
    public function mount(){
        $this->name = 'Silvio Conejo';
    }


    public function render()
    {
        return view('livewire.caixas');
    }
}
