<div class="row layout-top-spacing"> {{-- classes do template --}}

    <div class="col-sm-12 col-md-12-col-lg-12 layout-spacing"> {{-- só col-sm-12 já faria a mesma coisa --}}

        {{-- se action = 1 mostrar a listagem --}}
        @if ($action == 1)

            <div class="widget-content-area br-4">
                
                <div class="widget-header">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <h5><b>Gavetas de Estacionamento</b></h5>
                        </div>
                    </div>
                </div>


                {{-- incluir arquivo com o campo busca e o botão novo --}}
                @include('common.search')

                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>DESCRIÇÃO</th>
                                <th>STATUS</th>
                                <th>TIPO</th>
                                <th>AÇÕES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($info as $r)
                                <td>{{r->id}}</td>
                                <td>{{r->descricao}}</td>
                                <td>{{r->status}}</td>
                                <td>{{r->tipo}}</td>
                                <td class="text-center">
                                    {{-- incluir o arquivo onde estão os botões de ação --}}
                                    @include('common.actions')
                                </td>
                            @endforeach
                        </tbody>
                    </table>
                    {{$info->links()}}

                </div>

            </div>



        {{-- se action for = 2 incluir o formulário --}}
        @elseif($action == 2)

            @include('livewire.gavetas.form')
            
        @endif

    </div>

</div>



<script>
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
</script>