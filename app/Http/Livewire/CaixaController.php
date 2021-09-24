<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Artisan;

use Livewire\Component;
use Livewire\WithPagination;
use App\Caixa;


class CaixaController extends Component
{


    use WithPagination;

    public $tipo = 'Escolher', $descricao, $valor, $comprovante;
    public $selected_id, $search;
    public $action = 1, $pagination = 5;


    public function render()
    {

        if(strlen($this->search) > 0)
        {
            return view('livewire.caixas.caixaComponent', [
                'info' => Caixa::where('tipo', 'like' .'%' . $this->search .'%')
                ->orWhere('descricao', 'like' .'%'. $this->search .'%')
                ->paginate($this->pagination),
            ]);
        } else {
            $caixas = Caixa::leftjoin('users as u', 'u.id', 'caixas.user_id')
            ->select('caixas.*', 'u.nome')
            ->orderBy('id', 'desc')
            ->paginate($this->pagination);

            return view('livewire.caixas.caixa-component', [
                'info' => $caixas
            ]);
        }
        
    }
}
