@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-sm-4">
        <h2 class="title">Usuarios</h2>
    </div>
    <div class="col-sm-8 text-right">
        <button class="btn btn-link" data-toggle="modal" data-target="#newUser">
            <i class="icon ion-md-add"></i> Nuevo Usuario
        </button>
    </div>
</div>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Editar</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{ucfirst($roles[$user->id])}}</td>
            <td>
                <i class="icon ion-md-create btnEdit" data-id="{{$user->id}}"></i>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="modal fade" id="newUser" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nuevo Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ url('admin/usuarios') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Nombre</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" id="inputPassword">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" name="email" class="form-control" id="inputPassword">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Contraseña</label>
                        <div class="col-sm-10">
                            <input type="password" name="password" class="form-control" id="inputPassword">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Rol</label>
                        <div class="col-sm-10">
                            <select name="role" class="form-control" id="">
                                <option value="">Seleccione un rol</option>
                                <option value="1">Administrador</option>
                                <option value="2">Supervisor</option>
                                <option value="3">Asesor</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row d-none branchSelecter">
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

<div class="modal fade" id="editUser" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Usuario</h5>
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
                        <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" name="email" class="form-control editEmail" id="inputPassword">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Contraseña</label>
                        <div class="col-sm-10">
                            <input type="password" name="password" class="form-control" id="inputPassword">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Rol</label>
                        <div class="col-sm-10">
                            <select name="role" class="form-control editRole" id="">
                                <option value="">Seleccione un rol</option>
                                <option value="1">Administrador</option>
                                <option value="2">Supervisor</option>
                                <option value="3">Asesor</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row editBranchSelecter">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Sucursal</label>
                        <div class="col-sm-10">
                            <select name="branch" class="form-control editBranch" id="">
                                <option value="">Seleccione una sucursal</option>
                                @foreach($branches as $branch)
                                <option value="{{$branch->id}}">{{$branch->name}}</option>
                                @endforeach
                            </select>
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

    $('select[name="role"]').change(function(){
        let index = $(this).val()
        if(index > 1){
            $('.branchSelecter').removeClass('d-none');
        }else{
            $('.branchSelecter').addClass('d-none');
        }
    })
    $('.btnEdit').click(function() {
        let id = $(this).data('id')
        /*$.ajax({
            url: '{{ url("admin/sucursal") }}/'ìd,
            method: 'GET',
            success:
        })*/
        const client = fetch('{{ url("admin/usuarios") }}/' + id)
            .then(function(response) {
                return response.json();
            })
            .then(function(response) {
                $('.editId').val(response.data.id)
                $('.editName').val(response.data.name)
                $('.editEmail').val(response.data.email)
                $('.editRole').val(response.data.role_id)
                if (response.data.role_id > 1) {
                    $(".editBranchSelecter").removeClass("d-none");
                    $('select[name="branch"]').val(response.data.branch_id)
                }else{
                    $(".editBranchSelecter").addClass("d-none");
                }

                $('#editUser').find('form').attr('action', '{{ url("admin/usuarios") }}/' + id);
                $('#editUser').modal();
            });
    })
</script>
@endsection