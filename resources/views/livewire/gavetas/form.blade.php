<div class="widget-content-area">
    <div class="widget-one">
        {{-- arquivo onde estão as mensagens de validação --}}
        @include('common.messages')

        <div class="row">

            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                <label for="">Nome</label>
                <input type="text" wire:model.lazy="descricao" class="form-control" placeholder="">
            </div>
            
            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                <label for="">Tipo</label>
                <select name="" id="" wire:model="tipo">
                    <option value="Escolher" disabled>Escolher</option>
                    @foreach ($tipos as $tipo)
                        <option value="{{$tipo->id}}">{{$tipo->descricao}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                <label for="">Status</label>
                <select name="" id="" wire:model="status">
                    <option value="DISPONIVEL">DISPONÍVEL</option>
                    <option value="OCUPADO">OCUPADO</option>
                </select>
            </div>


            <div class="col-lg-5 mt-2 text-left">
                <button type="button" class="btn btn-dark mr-1" wire:click="doAction(1)">
                    <i class="mbri-left"></i>
                    Voltar
                </button>

                <button type="button" class="btn btn-primary-ml2" wire:click.prevent="storeOrUpdate()">
                    <i class="mbri-success"></i>
                    Gravar
                </button>
            </div>


            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                <label for="">Nome</label>
                <input type="text" wire:model.lazy="descricao" class="form-control" placeholder="">
            </div>

            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                <label for="">Nome</label>
                <input type="text" wire:model.lazy="descricao" class="form-control" placeholder="">
            </div>

        </div>
    </div>
</div>