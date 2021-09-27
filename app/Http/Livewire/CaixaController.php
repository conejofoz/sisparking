<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Artisan;

use Livewire\Component;
use Livewire\WithPagination;
use App\Caixa;
use Illuminate\Support\Facades\Auth;

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



    public function updateSearch()
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
        $this->descricao = '';
        $this->tipo = 'Escolher';
        $this->valor = '';
        $this->comprovante= '';
        $this->selected_id = null;
        $this->action = -1;
        $this->search = '';
    }


    public function edit($id)
    {
        $record = Caixa::find($id);
        $this->descricao = $record->descricao;
        $this->tipo =  $record->tipo;
        $this->valor =  $record->valor;
        $this->comprovante=  $record->comprovante;
        $this->selected_id = $id;
        $this->action =  $record->action;
    }


    public function storeOrUpdate()
    {
        $this->validate([
            'tipo' => 'not_in:Escolher'
        ]);

        $this->validate([
            'tipo' => 'required',
            'valor' => 'required',
            'descricao' => 'required'
        ]);

        /* novo registro */
        if($this->selected_id <=0 )
        {
            $caixa = Caixa::create([
                'valor' => $this->valor,
                'tipo' => $this->tipo,
                'descricao' => $this->descricao,
                'user_id' => Auth::user()->id // auth()->user()->id
            ]);

            if($this->comprovante)
            {
                $image = $this->comprovante;
                $fileName = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';'))))[1][1];
                $moved = \Image::make($image)->save('images/movs/'.$fileName);

                if($moved)
                {
                    $caixa->comprovante = $fileName;
                    $caixa->save();
                }
            }
        } 
        else 
        {
            $record = Caixa::find($this->selected_id);
            
            $record = Caixa::update([
                'valor' => $this->valor,
                'tipo' => $this->tipo,
                'descricao' => $this->descricao,
                'user_id' => Auth::user()->id 
            ]);

            if($this->comprovante)
            {
                $image = $this->comprovante;
                $fileName = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';'))))[1][1];
                $moved = \Image::make($image)->save('images/'.$fileName);

                if($moved)
                {
                    $record->comprovante = $fileName;
                    $record->save();
                }
            }
        }


        if($this->selected_id)
            $this->emit('msgok', 'Movimento de caixa atualizado com sucesso!');
        else
            $this->emit('msgok', 'Movimento de caixa criado com sucesso!');

        $this->resetInput();
        
    }


    protected $listeners = [
        'deliteRow' => 'destroy',
        'fileUpload' => 'handleFileUpload'
    ];


    protected function handleFileUpload()
    {
        $this->comprovante = $imageData;
    }


    public function destroy($id)
    {
        if($id)
        {
            $record = Caixa::where('id', $id);
            $record->delete();
            $this->resetInput();
        }
    }

}
