<div class="widget-content-area">
    <div class="widget-one">
        <form>
            <h3>Criar/Editar Movimentos</h3>   
            {{-- arquivo onde estão as mensagens de validação --}}
            @include('common.messages')

            <div class="row">

                
                <div class="form-group col-lg-4 col-md-4 col-sm-12">    
                    <label>Tipo</label>
                    <select wire:model.lazy="tipo" class="form-control text-center">
                        <option value="Escolher">Escolher</option>
                        <option value="Receita">Receita</option>
                        <option value="Despesa">Despesa</option>
                        <option value="Pagamento de Renda">Pagamento de Renda</option>
                        
                    </select>
                </div>


                <div class="form-group col-lg-4 col-md-4 col-sm-12">
                    <label for="">Valor</label>
                    <input type="number" wire:model.lazy="valor" class="form-control text-center" placeholder="">
                </div>


                <div class="form-group col-lg-4 col-md-4 col-sm-12">
                    <label for="">Comprovante</label>
                    <input type="file" id="image" wire:change="$emit('fileChoosen', this)" accept="image/x-png, image/gif, image/jpeg" class="form-control" placeholder="">
                </div>

                
                <div class="form-group col-lg-12 col-sm-12 mb-8">
                    <label for="">Descrição</label>
                    <input type="text" wire:model.lazy="descricao" class="form-control" placeholder="">
                </div>



                <div class="row">
                    <div class="col-xs-5 mt-2 text-left">
                        <button type="button" class="btn btn-dark mr-1" wire:click="doAction(1)">
                            <i class="mbri-left"></i>
                            Voltar
                        </button>
        
                        <button type="button" class="btn btn-primary-ml2" wire:click.prevent="storeOrUpdate()">
                            <i class="mbri-success"></i>
                            Gravar
                        </button>
                    </div>
                </div>
            
            
            </div>
        
        </form>
    </div>
</div>
