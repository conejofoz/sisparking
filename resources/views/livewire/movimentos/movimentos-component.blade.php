<div class="main-content">
    @if ($action == 1)
        <div class="layout-pc-spacing">

            <div class="row layout-top-spacing">
                <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 layout-spacing">
                    <div class="widget-content-area br-4">
                        <div class="widget-one">
                            <h3>Movimento de caixa</h3>
                            @include('common.search')
                            @include('common.alerts')
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
                                    <thead>
                                        <tr>
                                            <th>DESCRIÇÃO</th>
                                            <th>TIPO</th>
                                            <th>VALOR</th>
                                            <th>COMPROVANTE</th>
                                            <th>DATA</th>
                                            <th>AÇÕES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($info as $r)
                                            <tr>
                                                <td>{{$r->descricao}}</td>
                                                <td>{{$r->tipo}}</td>
                                                <td>{{$r->valor}}</td>
                                                <td>
                                                    <img src="storage/images/movs/{{$r->comprovante}}" alt="" height="40" class="rounded">
                                                </td>
                                                <td>{{$r->created_at}}</td>
                                                <td class="text-center">
                                                    {{-- incluir o arquivo onde estão os botões de ação --}}
                                                    @include('common.actions')
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{$info->links()}}
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    @elseif($action == 2)
        @include('livewire.movimentos.form')
    @endif
</div>




<script>
    document.addEventListener('DOMContentLoaded', function(){
        window.livewire.on('fileChoosen', ()=>{
            let inputField = document.getElementById('image')
            let file = inputField.files[0]
            let reader = new FileReader();
            reader.onloadend = ()=>{
                window.livewire.emit('fileUpload', reader.result)
            }
            reader.readAsDataURL(file)
        })
    })


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