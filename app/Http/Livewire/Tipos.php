<?php

namespace App\Http\Livewire;

use Livewire\WithPagination;
use Livewire\Component;
use App\Tipo;

class Tipos extends Component
{

    use WithPagination;

    public $descricao;
    public $selected_id;
    public $search;
    public $action = 1;
    public $pagination = 5;




    public function mount()
    {

    }


    public function render()
    {

        if(strlen($this->search) > 0)
        {

            $info = Tipo::where('descricao', 'like', '%' . $this->search .'%')->paginate($this->pagination);

            //return view('livewire.tipos.component', ['info' => $info]);
            //dd($info);
            return view('livewire.tipos.component', ['info' => $info]);

        } else {

            $info = Tipo::paginate($this->pagination);

            
            return view('livewire.tipos.component', compact('info'));

        }
    }



    public function updatingSearch(): void
    {
        $this->gotoPage(1);
    }


    //Alternar entre telas de listagem ou edição dependendo do valor de $action
    public function doAction($action)
    {
        $this->action = $action;
    }



    public function resetInput()
    {
        $this->descricao = '';
        $this->selected_id = null;
        $this->action = 1;
        $this->search = '';
    }



    public function edit($id)
    {
        $record = Tipo::findOrFail($id);
        $this->descricao = $record->descricao;
        $this->selected_id = $record->id;
        $this->action = 2;
    }



    public function storeOrUpdate()
    {

        //Validar a descrição
        $this->validate(
            [
                'descricao' => 'required|min:4'
            ]
        );

        //Validar se existe outro registro com a mesma descricao
        if( $this->selected_id > 0)
        {
            $existe = Tipo::where('descricao', $this->descricao)
            ->where('id', '<>', $this->selected_id)
            ->select('descricao')->get();

            if( $existe->count() > 0 )
            {
                session()->flash('msg-error', 'Já existe o registro!');
                $this->resetInput();
                return;
            }
        } else {
            $existe = Tipo::where('descricao', $this->descricao)
            ->select('descricao')->get();

            if( $existe->count() > 0 )
            {
                session()->flash('msg-error', 'Já existe o registro!');
                $this->resetInput();
                return;
            }

        }


        if( $this->selected_id <=0 )
        {
            $record = Tipo::create([
                'descricao' => $this->descricao
            ]);
        } else {
            $record = Tipo::find($this->selected_id);
            $record->update([
                'descricao' => $this->descricao
            ]);
        }

        if( $this->selected_id )
        {
            session()->flash('message', 'Tipo Atualizado!');
        } else {
            session()->flash('message', 'Tipo Criado!');

        }

        $this->resetInput();
    }



    public function destroy($id)
    {
        if($id)
        {
            $record = Tipo::find($id);
            $record->delete();
            $this->resetInput();
        }
    }



    /**
     * Listeners
     * Escutar eventos e executar ações
     * No front através de javascript emitimos um evento
     * que é recuperado aqui no controlador. E quando chega aqui dispara o método destroy.
     * Nesse exemplo foi emitido um evento chamado deleteRow juntamente com o id
     * que não aparece aqui mais é manipulado internamente por livewire
     * window.livewire.emit('deleteRow', id)
     * Esse id é capturado quando clica-se no botão delete e enviado para uma função javascript
     * <a href="javascript:void(0);" onclick="Confirm('{{$r->id}}')"
     */
    protected $listeners = [
        'deleteRow' => 'destroy'
    ];

}