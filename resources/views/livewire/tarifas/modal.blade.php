<!-- Modal -->
<div class="modal fade" id="modalTarifa" tabindex="-1" aria-labelledby="modalTarifa" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Descrição do veículo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
            <div class="widget-content-area">
                <div class="widget-one">
                    <form>
                        {{-- <h3>Criar/Editar Movimentos</h3>    --}}
                        {{-- arquivo onde estão as mensagens de validação --}}
                        {{-- @include('common.messages') --}}
            
                        <div class="row">
            
                            
                            <div class="form-group col-lg-4 col-md-4 col-sm-12">    
                                <label>Tempo</label>
                                <select class="form-control text-center" id="tempo">
                                    <option value="Selecionar">Selecionar</option>
                                    <option value="Hora">Hora</option>
                                    <option value="Dia">Dia</option>
                                    <option value="Semana">Semana</option>
                                    <option value="Mes">Mês</option>
                                    
                                </select>
                            </div>
            
            
                            <div class="form-group col-lg-4 col-md-4 col-sm-12">    
                                <label>Tipo</label>
                                <select id="tipo" class="form-control text-center">
                                    <option value="Selecionar">Selecionar</option>
                                    @foreach ($tipos as $t)
                                        <option value="{{$t->id}}">{{$t->descricao}}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
            
            
                            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                                <label for="">Custo</label>
                                <input type="number" id="custo" class="form-control text-center" value="0" placeholder="">
                            </div>
            
                            
                            <div class="form-group col-lg-12 col-sm-12 mb-8">
                                <label for="">Descrição</label>
                                <input type="text" id="descricao" class="form-control" placeholder="">
                            </div>
            
            
                            <div class="form-group col-lg-12 col-sm-12 mb-8">
                                <label for="">Hierarquia</label>
                                <input type="text" id="hierarquia" class="form-control text-center" disabled value="{{$hierarquia}}">
                            </div>
            
                        
                        </div>
                    
                    </form>
                </div>
            </div>


            
        </div>
        <div class="modal-footer">
          <button class="btn btn-dark" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancelar</button>
          <button type="button" onclick="save()" class="btn btn-primary saveTarifa">Gravar</button>
        </div>
      </div>
    </div>
  </div>








