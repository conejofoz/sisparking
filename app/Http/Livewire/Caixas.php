<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Caixa;
use App\Tipo;

class Caixas extends Component
{

    use WithPagination;


    public $tipo = "Escolher", $descricao, $status="DISPONÍVEL", $tipos;
    public $selected_id, $search;
    public $action = 1, $pagination = 5;


    
    public function mount(){
    

    }


    public function render()
    {
        $tipos = Tipo::all();

        if(strlen($this->search) > 0)
        {
            $info = Caixa::leftjoin('tipos as t', 't.id', 'caixas.tipo_id')
            ->select('caixas.*', 't.descricao as tipo')
            ->where('caixas.descricao', 'like', '%' . $this->search .'%')
            ->orWhere('caixas.status', 'like', '%' . $this->search .'%')
            ->paginate($this->pagination);

            return view('livewire.caixas.caixas', ['info' => $info]);

        } else {

            $info = Caixa::leftjoin('tipos as t', 't.id', 'caixas.tipo_id')
            ->select('caixas.*', 't.descricao as tipo')
            ->orderBy('caixas.id', 'desc')
            ->paginate($this->pagination);

            return view('livewire.caixas.caixas', ['info' => $info]);

        }
    }


    public function updatingSearch()
    {
        $this->gotoPage(1);
    }



    public function doAction($action)
    {
        $this->action = $action;
    }



    public function resetInput()
    {
        $this->descricao = '';
        $this->tipo = 'Escolher';
        $this->status= 'DISPONÍVEL';
        $this->selected_id= null;
        $this->action = -1;
        $this->search = '';
    }



    public function edit($id)
    {
        $record = Caixa::find($id);
        $this->descricao = $record->descricao;
        $this->tipo = $record->tipo_id;
        $this->status= $record->status;
        $this->selected_id = $id;
        $this->action = 2;
    }



    public function storeOrUpdate()
    {

        //não permitir o primeiro option que é Escolher
        $this->validate(
            [
                'tipo' => 'not_in:Escolher'
            ]
        );

        $this->validate([
            'tipo' => 'required',
            'descricao' => 'required',
            'status' => 'required'
        ]);

        if($this->selected_id <=0)
        {
            $caixa = Caixa::create([
                'descricao' => $this->descricao,
                'tipo_id' => $this->tipo,
                'status' => $this->status
            ]);
        } else {
            $record = Caixa::find($this->selected_id);
            $record->create([
                'descricao' => $this->descricao,
                'tipo_id' => $this->tipo,
                'status' => $this->status
            ]);
        }

        if($this->selected_id)
        {
            $this->emit('msgok', 'Caixa atualizado com sucesso!');
        } else {
            $this->emit('msgok', 'Caixa criado com sucesso!');
        }

        $this->resetInput();
    }



    public function destroy($id)
    {
        if($id)
        {
            $record = Caixa::find($id);
            $record->delete();
            $this->resetInput();
            $this->emit('msgok', 'Registro eliminado com sucesso!');
        }
    }



    protected $listeners = ['deleteRow', 'destroy'];
    
}
