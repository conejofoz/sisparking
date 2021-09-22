<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Caixa;
use App\Tipo;

class Caixas extends Component
{
    public $tipo = "Escolher", $descricao, $status="DISPONÍVEL", $tipos;
    public $selected_id, $search;
    public $action = 1, $pagination = 5;


    
    public function mount(){
    

    }


    public function render()
    {
        $tipos = Tipo::all();
        return view('livewire.caixas');
    }
}
