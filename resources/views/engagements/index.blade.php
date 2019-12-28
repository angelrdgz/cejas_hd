@extends('layouts.admin')

@section('content')
<div class="row buffer">
    <div class="col-sm-12">
        <h3 class="title">Citas Confirmadas</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th># Orden</th>
                    <th>Servicio</th>
                    <th>Status</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Editar</th>
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
                    <td>{{date('d F', strtotime($engagement->reservation))}}</td>
                    <td>{{date('g:i A', strtotime($engagement->reservation))}}</td>
                    <td>
                        <i class="ion-edit"></i>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">
                    <a class="btn btn-link">PDF Mensual</a>
                    </td>
                    <td colspan="4" class="text-right">
                        <button class="btn btn-secondary" data-toggle="modal" data-target="#newEngagement">Nueva Cita</button>
                        <button class="btn btn-secondary">Bloquear Horas</button>
                        <button class="btn btn-secondary">Cancelar Cita</button>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<div class="row buffer">
    <div class="col-sm-12">
        <h3 class="title">Citas Pendientes</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th># Orden</th>
                    <th>Servicio</th>
                    <th>Status</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pendingEngagements as $engagement)
                <tr>
                    <td>#{{$engagement->id}}</td>
                    <td>{{$engagement->service->name}}</td>
                    <td>
                        <span class="badge badge-warning">{{$engagement->status}}</span>
                    </td>
                    <td>{{date('d F', strtotime($engagement->reservation))}}</td>
                    <td>{{date('g:i A', strtotime($engagement->reservation))}}</td>
                    <td>
                        <i class="ion-edit editEngagement"></i>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="newEngagement" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nueva Cita</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form method="POST" action="{{ url('admin/citas') }}">
                        @csrf
                    @if(Auth::user()->role_id == 1)
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Sucursal</label>
                        <div class="col-sm-10">
                            <select name="branch" class="form-control selectpicker" id="">
                                <option value="" disabled>Seleccionar sucursal</option>
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
                        <label for="inputPassword" class="col-sm-2 col-form-label">Cliente</label>
                        <div class="col-sm-10">
                        <select name="client" class="form-control selectpicker" data-live-search="true">
                                <option value="" disabled>Seleccionar cliente</option>
                                @foreach($clients as $client)
                                   <option value="{{$client->id}}">{{$client->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Asesor</label>
                        <div class="col-sm-10">
                        <select name="adviser" class="form-control selectpicker" id="">
                                <option value="" disabled>Seleccionar Asesor</option>
                                @foreach($advisors as $advisor)
                                   <option value="{{$advisor->id}}">{{$advisor->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Servicio</label>
                        <div class="col-sm-10">
                        <select name="service" class="form-control selectpicker" id="">
                                <option value="" disabled>Seleccionar sucursal</option>
                                @foreach($services as $service)
                                   <option value="{{$service->id}}">{{$service->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Fecha</label>
                        <div class="col-sm-10">
                            <input type="date" name="reservation" class="form-control" id="inputPassword">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Hora</label>
                        <div class="col-sm-10">
                            <select name="hour" id="" class="form-control">
                               <option value="" disabled>Seleccionar Hora</option>
                               @php
                                $range = range(strtotime('10:00'), strtotime('20:00'), 90*60);
                               @endphp
                               @foreach($range as $time)
                                <option value="{{date('H:i:s', $time)}}">{{date('H:i', $time)}} - {{date('H:i', strtotime('+90 minutes', strval($time)))}}</option>
                               @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Notas</label>
                        <div class="col-sm-10">
                           <textarea class="form-control" name="notes" id="" cols="30" rows="4"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3 offset-sm-3">
                        <button type="submit" class="btn btn-primary btn-block">Agendar</button>
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