@extends('layouts.admin')

@section('content')
<div class="row buffer ">
    <div class="col-sm-3">
        <div class="card">
            <div class="card-body">
                <br>
                <br>
                <h1 class="text-center">${{$money}}</h1>
                <br>
                <br>
            </div>
            <div class="card-footer text-muted text-center bg-peru">
                Comisiones
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="card">
            <div class="card-body">
                <br>
                <br>
                <h1 class="text-center">{{$totalComplete}}</h1>
                <br>
                <br>
            </div>
            <div class="card-footer text-muted text-center bg-burlywood">
                Servicios Completados
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="card">
            <div class="card-body">
               @if($next == NULL)
               <h2>No hay cita</h2>
               <h2>Registrada</h2>
               @else
                <h2 class="text-center">Cliente #{{$next->client_id}}</h2>
                <h2 class="text-center">{{$next->client->name}}</h2>
                <h2 class="text-center">{{$next->service->name}}</h2>
                <h2 class="text-center">{{date('h:m A', strtotime($next->reservation))}}</h2>
                <p class="text-center" style="margin-bottom:0;">Proxima Cita</p>
                @endif
            </div>
        </div>
    </div>
</div>
<br>
<div class="row bg-gray">
    <div class="col-sm-1">
    <i class="icon ion-md-clock"></i>
    </div>
    <div class="col-sm-11">Citas Recientes</div>
</div>
<div class="row buffer">
    <div class="col-sm-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th># Orden</th>
                    <th>Servicio</th>
                    <th>Status</th>
                    <th>Pago</th>
                </tr>
            </thead>
            <tbody>
            @foreach($engagements as $engagement)
                <tr>
                    <td>#{{$engagement->id}}</td>
                    <td>{{$engagement->service->name}}</td>
                    <td>
                        <span class="badge badge-success">{{$engagement->status}}</span>
                    </td>
                    <td>
                        {{$engagement->payment_method == NULL ? 'Pendiente': $engagement->payment_method}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection