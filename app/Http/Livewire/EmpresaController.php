<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Empresa;
use Illuminate\Support\Facades\DB;
use \Intervention\Image\Facades\Image;


class EmpresaController extends Component
{
    public $nome, $telefone, $email, $endereco, $logo, $event;

    public function mount(){

        $this->event = false;

        //$empresa = Empresa::select('*')->first();
        $empresa = Empresa::all();

        if($empresa->count() > 0)
        {
            $this->nome = $empresa[0]->nome;
            $this->telefone = $empresa[0]->telefone;
            $this->email = $empresa[0]->email;
            $this->endereco = $empresa[0]->endereco;
            $this->logo = $empresa[0]->logo;
        }

    }


    public function render()
    {
        return view('livewire.empresa.empresa-component');
    }


    protected $listeners = [
        'fileUpload' => 'logoUpload'
    ];


    public function logoUpload($imagemData)
    {
        $this->logo = $imagemData;
        $this->event = true;
    }


    public function guardar()
    {
        $rules = [
            'nome' => 'required',
            'telefone' => 'required',
            'email' => 'required|email',
            'endereco' => 'required'
        ];

        $custonMessages = [
            'nome.required' => 'O campo nome é obrigatório',
            'telefone.required' => 'O campo telefone é obrigatório',
            'email.required' => 'O campo e-mail é obrigatório',
            'email.email' => 'O campo e-mail é inválido',
            'endereco.required' => 'O campo endereço é obrigatório',
        ];

        $this->validate($rules, $custonMessages);

        DB::table('empresas')->truncate();

        $empresa = Empresa::create([
            'nome' => $this->nome,
            'telefone' => $this->telefone,
            'email' => $this->email,
            'endereco' => $this->endereco,
            //'logo' => $this->logo,
        ]);


        if($this->logo !=null && $this->event )
        {
            $imagem = $this->logo;
            $fileName = time().'.' . explode('/', explode(':', substr($imagem, 0, strpos($imagem, ';')))[1])[1];
            $moved = Image::make($imagem)->save('images/logo/'.$fileName);

            if($moved)
            {
                $empresa->logo = $fileName;
                $empresa->save();
            }
        }

        $this->emit('msgok', 'Informação da Empresa registrada!');


    }
}
