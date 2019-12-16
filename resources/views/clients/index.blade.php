@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-sm-4">
        <h2 class="title">Clientes</h2>
    </div>
    <div class="col-sm-8 text-right">
        <button class="btn btn-link" data-toggle="modal" data-target="#newClient">
            <i class="icon ion-md-add"></i> Nuevo Cliente
        </button>
    </div>
</div>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>Email</th>
            <th>Fecha Nacimiento</th>
            <th>Editar</th>
        </tr>
    </thead>
    <tbody>
        @foreach($clients as $client)
        <tr>
            <td>{{$client->id}}</td>
            <td>{{$client->name}}</td>
            <td>{{$client->phone}}</td>
            <td>{{$client->email}}</td>
            <td>{{date('d/m/Y', strtotime($client->birthday))}}</td>
            <td>
                <i class="icon ion-md-create btnEdit" data-id="{{$client->id}}"></i>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="modal fade" id="newClient" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nuevo Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ url('admin/clientes') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Nombre</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" id="inputPassword">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Teléfono</label>
                        <div class="col-sm-10">
                            <input type="text" name="phone" class="form-control" id="inputPassword">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" name="email" class="form-control" id="inputPassword">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Cumpleaños</label>
                        <div class="col-sm-10">
                            <input type="date" name="birthday" class="form-control" id="inputPassword">
                        </div>
                    </div>
                    @if(Auth::user()->role_id == 1)
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Sucursal</label>
                        <div class="col-sm-10">
                            <select name="branch" class="form-control" id="">
                                <option value="">Seleccione una sucursal predeterminada</option>
                                @foreach($branches as $branch)
                                <option value="{{$branch->id}}">{{$branch->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @else
                    <input type="hidden" name="branch" value="{{Auth::user()->branch_id}}">
                    @endif
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Género</label>
                        <div class="col-sm-10">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" checked name="genere" id="inlineRadio1" value="1">
                                <label class="form-check-label" for="inlineRadio1">Masculino</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="genere" id="inlineRadio2" value="2">
                                <label class="form-check-label" for="inlineRadio2">Femenino</label>
                            </div>
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

<div class="modal fade" id="editClient" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ url('admin/clientes') }}">
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
                        <label for="staticEmail" class="col-sm-2 col-form-label">Teléfono</label>
                        <div class="col-sm-10">
                            <input type="text" name="phone" class="form-control editPhone" id="inputPassword">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" name="email" class="form-control editEmail" id="inputPassword">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Cumpleaños</label>
                        <div class="col-sm-10">
                            <input type="date" name="birthday" class="form-control editBirthday" id="inputPassword">
                        </div>
                    </div>
                    @if(Auth::user()->role_id == 1)
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Sucursal</label>
                        <div class="col-sm-10">
                            <select name="branch" class="form-control editBranch" id="">
                                <option value="">Seleccione una sucursal predeterminada</option>
                                @foreach($branches as $branch)
                                <option value="{{$branch->id}}">{{$branch->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @else
                    <input type="hidden" name="branch" value="{{Auth::user()->branch_id}}">
                    @endif
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Género</label>
                        <div class="col-sm-10">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" id="male" type="radio" name="genere" id="inlineRadio1" value="1">
                                <label class="form-check-label" for="inlineRadio1">Masculino</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" id="female" type="radio" name="genere" id="inlineRadio2" value="2">
                                <label class="form-check-label" for="inlineRadio2">Femenino</label>
                            </div>
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
        const client = fetch('{{ url("admin/clientes") }}/' + id)
            .then(function(response) {
                return response.json();
            })
            .then(function(response) {
                $('.editId').val(response.data.id)
                $('.editName').val(response.data.name)
                $('.editPhone').val(response.data.phone)
                $('.editEmail').val(response.data.email)
                $('.editBirthday').val(response.data.birthday)
                if (response.data.genere == 1) {
                    $("#male").prop("checked", true);
                } else {
                    $("#female").prop("checked", true);
                }

                $('#editClient').find('form').attr('action', '{{ url("admin/clientes") }}/' + id);
                $('#editClient').modal();
            });
    })
</script>
@endsection