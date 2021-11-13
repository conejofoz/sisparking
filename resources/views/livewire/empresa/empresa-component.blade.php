<div class="widget-content-area">
    <div class="widget-one">
        <div class="row">
            @include('common.messages')
            <div class="col-12">
                <h4 class="text-center">Dados da Empresa</h4>
            </div>
            <div class="form-group col-sm-12">
                <label>Nome</label>
                <input wire:model.lazy="nome" type="text" class="form-control text-left">
            </div>
            
            <div class="form-group col-sm-12">
                <label>Telefone</label>
                <input wire:model.lazy="telefone" maxlength="12" type="text" class="form-control text-center">
            </div>

            <div class="form-group col-sm-12">
                <label>Email</label>
                <input wire:model.lazy="email" maxlength="65" type="text" class="form-control text-center">
            </div>

            <div class="form-group col-sm-12">
                <label>Logo</label>
                {{-- <input type="file" class="form-control" id="imagem"> --}}
                <input type="file" id="imagem" wire:change="$emit('fileChoosen', this)" accept="image/x-png, image/gif, image/jpeg" class="form-control" placeholder="">
            </div>

            <div class="form-group col-sm-12">
                <label>Endereço</label>
                <input wire:model.lazy="endereco" type="text" class="form-control text-left">
            </div>

            <div class="col-sm-12">
                <button wire:click.prevent="guardar" class="btn btn-primary ml-2"><i class="mbri-success">Guardar</i></button>
            </div>

        </div>
    </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function(){
        window.livewire.on('fileChoosen', ()=>{
            let inputField = document.getElementById('imagem')
            let file = inputField.files[0]
            let reader = new FileReader();
            reader.onloadend = ()=>{
                window.livewire.emit('fileUpload', reader.result)
            }
            reader.readAsDataURL(file)
        })
    })
</script>
