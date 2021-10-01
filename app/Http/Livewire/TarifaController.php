<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Tarifa;
use App\Tipo;
use DB;

class TarifaController extends Component
{

    use WithPagination;

    public $tempo = 'Selecionar';
    public $tipo = 'Selecionar';
    public $descricao;
    public $custo;
    public $hierarquia;
    public $selected_id;
    public $search;
    public $action = 1;
    public $pagination = 5;
    public $tipos;
    

    public function mount()
    {
        $this->getHierarquia();
    }


    public function getHierarquia(){

        $tarifa = Tarifa::count();
        if($tarifa > 0)
        {
            $tarifa = Tarifa::select('hierarquia')->orderBy('hierarquia', 'desc')->first();
            $this->hierarquia = $tarifa->hierarquia + 1;
        }
    }


    public function render()
    {
        return view('livewire.tarifas.component-tarifas');
    }
}
