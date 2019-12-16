@extends('layouts.admin')

@section('content')
<h2 class="title">Calendario</h2>
<div id="calendar" style="height: 800px;"></div>

<div class="modal fade" id="viewEngagement" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalle de Cita</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Cliente</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control client" id="inputPassword">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Asesor</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control adviser" id="inputPassword">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Sucursal</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control branch" id="inputPassword">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Servicio</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control service" id="inputPassword">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Fecha y Hora</label>
                    <div class="col-sm-10">
                        <input type="datetime-local" name="schedule" class="form-control schedule" id="inputPassword">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Notas</label>
                    <div class="col-sm-10">
                        <textarea name="" id="" cols="30" rows="4" class="form-control notes"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3 offset-sm-3">
                        <form method="POST" class="form-confirm" action="{{ url('admin/citas') }}">
                            <input name="_method" type="hidden" value="PUT">
                            @csrf
                            <input type="hidden" name="process" value="2">
                            <button type="submit" class="btn btn-success btn-block">Confirmar</button>
                        </form>
                    </div>
                    <div class="col-sm-3">
                        <form method="POST" class="form-confirm" action="{{ url('admin/citas') }}">
                            <input name="_method" type="hidden" value="PUT">
                            @csrf
                            <input type="hidden" name="process" value="4">
                            <button type="submit" class="btn btn-danger btn-block">Cancelar</button>
                        </form>
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
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var engagements = [];
        let colors = {
            Cancelada: '#FF001A',
            Pendiente: '#0000FF',
            Confirmada: '#15B800'
        }

        @foreach($engagements as $engagement)

        engagements.push({
            id: '{{$engagement->id}}',
            title: '{{$engagement->service->name}}',
            start: '{{$engagement->reservation}}',
            end: '{{date("Y-m-d H:i:s", strtotime("+90 minutes", strtotime($engagement->reservation)))}}',
            color: colors['{{$engagement->status}}'],
            textColor: '#fff'
        });
        @endforeach

        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: ['timeGrid'],
            timeZone: 'UTC',
            locale: 'es',
            defaultView: 'timeGridWeek',
            eventClick: function(info) {
                console.log(info.event)
                let id = info.event.id

                const client = fetch('{{ url("admin/citas") }}/' + id)
                    .then(function(response) {
                        return response.json();
                    })
                    .then(function(response) {
                        console.log(response)
                        $('.client').val(response.data.client.name)
                        $('.service').val(response.data.service.name)
                        $('.adviser').val(response.data.adviser.name)
                        $('.branch').val(response.data.branch.name)
                        $('.schedule').val(response.data.reservation.replace(' ', 'T'))
                        $('.notes').val(response.data.notes)

                        $('.form-confirm').attr('action', '{{ url("admin/citas") }}/' + id);
                        $('.form-cancel').attr('action', '{{ url("admin/citas") }}/' + id);

                        $('#viewEngagement').modal();
                    });
            },
            events: engagements
        });

        calendar.render();
    });
</script>
@endsection