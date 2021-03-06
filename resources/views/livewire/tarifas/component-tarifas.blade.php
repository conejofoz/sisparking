<div class="row layout-top-spacing"> {{-- classes do template --}}

    <div class="col-sm-12 col-md-12-col-lg-12 layout-spacing"> {{-- só col-sm-12 já faria a mesma coisa --}}

        {{-- se action = 1 mostrar a listagem --}}
        {{-- @if ($action == 1) --}}

            <div class="widget-content-area br-4">
                
                <div class="widget-header">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <h5><b>Tarifas de sistema</b></h5>
                        </div>
                    </div>
                </div>


                {{-- incluir arquivo com o campo busca e o botão novo --}}
                {{-- @include('common.search') --}}

                <div class="row justify-content-between mb-4 mt-3">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                         <div class="input-group ">
                               <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg></span>
                                       </div>
                                        <input type="text" wire:model="search" class="form-control" placeholder="Procurar.." aria-label="notification" aria-describedby="basic-addon1">
                                </div>
                    </div>
                    {{-- @can($create) --}}
                    <div class="col-md-2 col-lg-2 col-sm-12 mt-2 mb-2 text-right mr-2">
                         {{-- <button type="button" wire:click="doAction(2)" class="btn btn-dark"> --}}
                         <button type="button" onclick='openModal("{{$hierarquia}}")' class="btn btn-dark">
                              <i class="la la-file la-lg"></i>
                        </button>
                    </div>
                    {{-- @endcan --}}
                </div>



                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>TEMPO</th>
                                <th>DESCRIÇÃO</th>
                                <th>CUSTO</th>
                                <th>TIPO</th>
                                <th>HIERARQUIA</th>
                                <th>AÇÕES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($info as $r)
                            <tr>
                                <td>{{$r->id}}</td>
                                <td>{{$r->tempo}}</td>
                                <td>{{$r->descricao}}</td>
                                <td>{{$r->custo}}</td>
                                <td>{{$r->tipo}}</td>
                                <td>{{$r->hierarquia}}</td>
                                <td class="text-center">
                                    {{-- incluir o arquivo onde estão os botões de ação --}}
                                    {{-- @include('common.actions') --}}
                                    
                                    {{-- action sem liveware --}}
                                    <ul class="table-controls">
                                        {{-- @can($edit) --}}
                                        <li>
                                            <a href="javascript:void(0);" onclick="editTarifa('{{$r}}')" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" 
                                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 text-success">
                                                <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>
                                        </li>
                                        {{-- @endcan --}}
                                        
                                    
                                    
                                        {{-- @can($destroy) --}}
                                        <li>
                                           {{--  @if($r->renda->count() <=0 ) --}}
                                            <a href="javascript:void(0);"          		
                                            onclick="Confirm('{{$r->id}}')"
                                            data-toggle="tooltip" data-placement="top" title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" 
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 text-danger">
                                            <polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            <line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a>
                                            {{-- @endif --}}
                                        </li>
                                        {{-- @endcan --}}
                                    
                                    
                                    </ul>
                                    {{-- action sem liveware --}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$info->links()}}

                </div>

            </div>



        {{-- se action for = 2 incluir o formulário --}}
        {{-- @elseif($action == 2) --}}

            @include('livewire.tarifas.modal')
            <input type="hidden" id="id" value="0">
            
        {{-- @endif --}}

    </div>

</div>



<script type="text/javascript">

    function Confirm(id)
    {       
       swal({
        title: 'CONFIRMAR',
        text: '¿DESEAS ELIMINAR EL REGISTRO?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
        closeOnConfirm: false
    },
    function() {        
        window.livewire.emit('deleteRow', id)    
       // toastr.success('info', 'Registro eliminado con éxito')
        swal.close()   
    })

   }



   function editTarifa(row)
   {
       var info = JSON.parse(row)
       $('#id').val(info.id)
       $('#custo').val(info.custo)
       $('#descricao').val(info.descricao)
       $('#tempo').val(info.tempo)
       $('#tipo').val(info.tipo_id)
       $('#hierarquia').val(info.hierarquia)
       $('#modal-title').text('Editar Tarifa')
       $('#modalTarifa').modal('show')
   }


   function openModal(hierarquia)
   {
       $('#id').val(0)
       $('#custo').val('')
       $('#descricao').val('')
       $('#tempo').val('Selecionar')
       $('#tipo').val('Selecionar')
       $('#hierarquia').val(hierarquia)
       $('#modal-title').text('Criar Tarifa')
       $('#modalTarifa').modal('show')
   }


   function save()
   {
        if($('#tempo option:selected').val() == 'Selecionar')
        {
            toastr.error('Escolha uma opção válida para o tempo!')
            return
        }
        if($('#tipo option:selected').val() == 'Selecionar')
        {
            toastr.error('Escolha uma opção válida para o tipo!')
            return
        }
        if($.trim($('#custo').val()) == '')
        {
            toastr.error('Digite um valor válido!')
            return 
        }


        var data = JSON.stringify({
            'id'         : $('#id').val(),
            'tempo'      : $('#tempo option:selected').val(),
            'tipo'       : $('#tipo option:selected').val(),
            'custo'      : $('#custo').val(),
            'descricao'  : $('#descricao').val(),
            'hierarquia' : $('#hierarquia').val(),
        })

        window.livewire.emit('createFromModal', data)
   }


   /*
   para exibir as mensagens
   */
   document.addEventListener('DOMContentLoaded', function(){
        window.livewire.on('msg-ok', dataMsg =>{
            $('#modalTarifa').modal('hide')
        })
        window.livewire.on('msg-error', dataMsg =>{
            $('#modalTarifa').modal('hide')
        })
   })


</script>