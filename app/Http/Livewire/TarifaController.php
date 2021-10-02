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
        $this->tipos = Tipo::all();
        if(strlen($this->search) > 0 )
        {
            $info = Tarifa::leftjoin('tipos as t', 't.id', 'tarifas.tipo_id')
            ->where('tarifas.descricao', 'like', '%' . $this->search . '%')
            ->orWere('tarifas.tempo', 'like', '%' . $this->search . '%')
            ->select('tarifas.*', 't.descricao as tipo')
            ->orderBy('tarifas.tempo', 'desc')
            ->orderBy('t.descricao')
            ->paginate($this->pagination);

            return view('livewire.tarifas.component-tarifas', ['info' => $info]);
        }
        else{
            /**
             * Se não for digitado nada na busca é só tirar o where
             */
            $info = Tarifa::leftjoin('tipos as t', 't.id', 'tarifas.tipo_id')
            ->select('tarifas.*', 't.descricao as tipo')
            ->orderBy('tarifas.tempo', 'desc')
            ->orderBy('t.descricao')
            ->paginate($this->pagination);
            
            return view('livewire.tarifas.component-tarifas', ['info' => $info]);

        }

        return view('livewire.tarifas.component-tarifas');
    }


    public function updatingSearch()
    {
        $this->gotoPage(1);
    }


    public function doAction($action)
    {
        $this->resetInput();
        $this->action = $action;
    }


    public function resetInput()
    {
        $this->tempo = '';
        $this->tipo = 'Selecionar';
        $this->descricao = '';
        $this->custo = '';
        $this->selected_id = null;
        $this->search = '';
        $this->action = 1;
        
        //$this->pagination = 5;
        //$this->hierarquia;
        //$this->tipos;
    }


    public function edit($id)
    {
        $record = Tarifa::find($id);
        $this->selected_id = $record->id;
        $this->descricao = $record->descricao;
        $this->tempo = $record->tempo;
        $this->custo = $record->custo;
        $this->tipo = $record->tipo->id;
        $this->hierarquia = $record->hierarquia;
        $this->action = 2;
    }


    public function storeOrUpdate()
    {
        $this->validate([
            'tempo' => 'requerido|not_in:Selecionar',
            'custo' => 'requerido',
            'tipo' => 'requerido|not_in:Selecionar',
        ]);

        if($this->selected_id > 0)
        {
            $existe = Tarifa::where('tempo', $this->tempo)
            ->where('tipo_id', $this->tipo)
            ->where('id', '<>', $this->selected_id)
            ->select('tempo')
            ->count();
        } else {
            $existe = Tarifa::where('tempo', $this->tempo)
            ->where('tipo_id', $this->tipo)
            ->select('tempo')
            ->count();
        }

        if($existe > 0)
        {
            $this->emit('msg-error', 'A tarifa já existe!');
            $this->resetInput();
            return;
        }

        if($this->selected_id <= 0 )
        {
            $tarifa = Tarifa::create([
                'tempo' => $this->tempo,
                'descricao' => $this->descricao,
                'custo' => $this->custo,
                'tipo_id' => $this->tipo,
                'hierarquia' => $this->hierarquia,
            ]);
        } else {
            $tarifa = Tarifa::find($this->selected_id);
            $tarifa->update([
                'tempo' => $this->tempo,
                'descricao' => $this->descricao,
                'custo' => $this->custo,
                'tipo_id' => $this->tipo,
                'hierarquia' => $this->hierarquia,
            ]);
        }


        //REVISAR MELHOR DEPOIS
        if($this->hierarquia == 1)
        {
            Tarifa::where('id', '<>', $tarifa->id)->update(['hierarquia' => 0 ]);
        }

        if($this->selected_id)
        {
            $this->emit('msg-ok', 'Tarifa atualizada!');
        } else{
            $this->emit('msg-ok', 'Tarifa criada!');

        }

        $this->resetInput();
        $this->getHierarquia();
    }


    protected $listeners = [
        'deleteRow' => 'destroy',
        'createFromModal' => 'createFromModal'
    ];


    public function createFromModal($info)
    {
        $data = json_decode($info);
        $this->selected_id = $data->id;
        $this->tempo = $data->tempo;
        $this->tipo = $data->tipo;
        $this->custo = $data->custo;
        $this->descricao = $data->descricao;
        $this->hierarquia = $data->hierarquia;
        
        $this->storeOrUpdate();
    }


    public function destroy($id)
    {
        if($id)
        {
            $record = Tarifa::find($id);
            $record->delete();
            $this->resetInput();
        }
    }
}
