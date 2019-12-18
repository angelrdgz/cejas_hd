@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-sm-4">
        <h2 class="title">Servicios</h2>
    </div>
    <div class="col-sm-8 text-right">
        <button class="btn btn-link" data-toggle="modal" data-target="#newService">
            <i class="icon ion-md-add"></i> Nuevo Servicio
        </button>
    </div>
</div>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Minutos</th>
            <th>Editar</th>
        </tr>
    </thead>
    <tbody>
        @foreach($services as $service)
        <tr>
            <td>{{$service->id}}</td>
            <td>{{$service->name}}</td>
            <td>${{$service->price}}</td>
            <td>{{$service->minutes}}</td>
            <td>
                <i class="icon ion-md-create btnEdit" data-id="{{$service->id}}"></i>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="modal fade" id="newService" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nuevo Servicio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ url('admin/servicios') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Nombre</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" id="inputPassword">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Precio</label>
                        <div class="col-sm-10">
                            <input type="text" name="price" class="form-control" id="inputPassword">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Duración (En minutos)</label>
                        <div class="col-sm-10">
                            <input type="text" name="minutes" class="form-control" id="inputPassword">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3 offset-sm-3">
                            <button type="submit" class="btn btn-primary btn-block">Guardar</button>
                        </div>
                        <div class="col-sm-3">
                            <button class="btn btn-secondary btn-block" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editService" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Servicio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ url('admin/servicios') }}">
                <input name="_method" type="hidden" value="PUT">
                <input name="id" type="hidden" class="editId" value="">
                    @csrf
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Nombre</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control editName" id="inputPassword">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Precio</label>
                        <div class="col-sm-10">
                            <input type="text" name="price" class="form-control editPrice" id="inputPassword">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Duración (En minutos)</label>
                        <div class="col-sm-10">
                            <input type="text" name="minutes" class="form-control editMinutes" id="inputPassword">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3 offset-sm-3">
                            <button type="submit" class="btn btn-primary btn-block">Guardar</button>
                        </div>
                        <div class="col-sm-3">
                            <button class="btn btn-secondary btn-block" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $('.btnEdit').click(function() {
        let id = $(this).data('id')
        /*$.ajax({
            url: '{{ url("admin/sucursal") }}/'ìd,
            method: 'GET',
            success:
        })*/
        const branch = fetch('{{ url("admin/servicios") }}/'+id)
            .then(function(response) {
                return response.json();
            })
            .then(function(response) {
                $('.editId').val(response.data.id)
                $('.editName').val(response.data.name)
                $('.editPrice').val(response.data.price)
                $('.editMinutes').val(response.data.minutes)
                $('#editService').find('form').attr('action', '{{ url("admin/servicios") }}/'+id);
                $('#editService').modal();
            });
    })
</script>
@endsection