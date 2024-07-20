@extends('layouts.app')

@section('content')
<div class="row mb-5 ml-2">
    @can('pbiblique_create')
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pbiblique-primary">
            @lang('quickadmin.qa_add_new')
        </button>
    @endcan
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="sticky-top mb-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Ajout des textes</h3>
                        </div>
                        <div class="card-body">
                           
                            <button id="add-new-text" type="button" class="btn btn-primary mt-3">Add</button>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Thème de la semaine</h3>
                        </div>
                        <div class="card-body">
                            <button id="add-new-theme" type="button" class="btn btn-primary mt-3">Add</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card card-primary">
                    <div class="card-body p-0">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include("superAdmin.pbiblique.modal")

@stop

@section('javascript')
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
    $(document).ready(function () {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: ['bootstrap', 'interaction', 'dayGrid', 'timeGrid'],
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            themeSystem: 'bootstrap',
            events: '{{ route("superAdmin.textsThemes.events") }}', // Correctly point to the route that provides events
            editable: true,
            droppable: true,
            eventClick: function(info) {
            var event = info.event;
            $('#eventModal').find('#eventTitle').val(event.title);
            $('#eventModal').find('#eventDate').val(event.start.toISOString().substring(0, 10));
            $('#eventModal').find('#eventTime').val(event.start.toISOString().substring(11, 16));
            $('#eventModal').find('#eventColor').val(event.backgroundColor);
            $('#eventModal').data('eventId', event.id);
            $('#eventModal').modal('show');
        },
        eventRender: function(info) {
            var event = info.event;
            if (event.backgroundColor.toLowerCase() === '#ffffff' || event.backgroundColor.toLowerCase() === 'rgb(255, 255, 255)') {
                info.el.style.color = '#000000'; // Set text color to black if background is white
            } else {
                info.el.style.color = '#ffffff'; // Default to black text
            }
                info.el.style.fontWeight = 'bold'; // Set font weight to bold
            },
        eventDrop: function(info) {
            var event = info.event;
            updateEvent(event);
        },
        eventResize: function(info) {
            var event = info.event;
            updateEvent(event);
        }
    });
        calendar.render();


        $('#add-new-text').click(function () {
            $('#addTextModal').modal('show');
        });

        $('#save-modal-text').click(function () {
            var title = $('#modalTexteBiblique').val();
            var date = $('#modalTexteBibliqueDate').val();
            var time = $('#modalTexteBibliqueHeure').val();
            var color = $('#modalTexteBibliqueColor').val();
            var startDate = date + 'T' + time;

            $.ajax({
                url: '{{ route("superAdmin.textsThemes.store") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    title: title,
                    start_date: startDate,
                    color: color,
                    time:time
                },
                success: function (response) {
                    console.log("hhhhhh",response);
                    if (response.status === 'success') {
                        calendar.addEvent({
                            id: response.event.id,
                            title: response.event.title,
                            start: response.event.start_date,
                            backgroundColor: response.event.color,
                            borderColor: response.event.color,
                        });
                        $('#addTextModal').modal('hide');
                    }
                }
            });
        });

        $('#add-new-theme').click(function () {
            $('#addThemeModal').modal('show');
        });

        $('#save-modal-theme').click(function () {
            var title = $('#modalThemeSemaine').val();
            var dateRange = $('#modalThemeSemaineDate').val();
            var color = $('#modalTexteBibliqueColor').val();
            var dates = dateRange.split(' - ');
            var startDate = dates[0];
            var endDate = dates[1];

            $.ajax({
                url: '{{ route("superAdmin.textsThemes.store") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    title: title,
                    start_date: startDate,
                    end_date: endDate,
                    color: color
                },
                success: function (response) {
                    if (response.status === 'success') {
                        calendar.addEvent({
                            title: response.event.title,
                            start: response.event.start_date,
                            end: response.event.end_date,
                            backgroundColor: response.event.color,
                            borderColor: response.event.color,
                        });
                        $('#addThemeModal').modal('hide');
                    }
                }
            });
        });



        $('#modalThemeSemaineDate').daterangepicker({
            locale: {
                format: 'YYYY-MM-DD'
            },
            startDate: moment().startOf('week'),
            endDate: moment().endOf('week'),
            ranges: {
                'Cette semaine': [moment().startOf('week'), moment().endOf('week')],
                'Semaine prochaine': [moment().add(1, 'week').startOf('week'), moment().add(1, 'week').endOf('week')],
                'Dernière semaine': [moment().subtract(1, 'week').startOf('week'), moment().subtract(1, 'week').endOf('week')],
            }
        });


        $('#save-event').click(function () {
           
        var eventId = $('#eventModal').data('eventId');
        var title = $('#eventTitle').val();
        var date = $('#eventDate').val();
        var time = $('#eventTime').val();
        var color = $('#eventColor').val();
        var startDate = date + 'T' + time;

        $.ajax({
            url: '{{ route("superAdmin.textsThemes.update")}}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                eventId:eventId,
                title: title,
                start_date: startDate,
                color: color,
                date:date,
            },
            success: function (response) {
                if (response.status === 'success') {
                    var event = calendar.getEventById(eventId);
                    event.setProp('title', title);
                    event.setStart(startDate);
                    event.setProp('backgroundColor', color);
                    event.setProp('borderColor', color);
                    $('#eventModal').modal('hide');
                }
            }
        });
    });

    $('#delete-event').click(function () {
        $('#confirmDeleteModal').modal('show'); // Afficher le modal de confirmation
    });



    $('#confirm-delete-event').click(function () {
        var eventId = $('#eventModal').data('eventId'); // Utiliser data('eventId') pour récupérer l'ID de l'événement


        $.ajax({
            url: '{{ route("superAdmin.textsThemes.destroy", '') }}/' + eventId,
            method: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                if (response.status === 'success') {
                    var event = calendar.getEventById(eventId);
                    event.remove();
                    $('#eventModal').modal('hide');
                    $('#confirmDeleteModal').modal('hide');
                }
            }
        });
    });


    function updateEvent(event) {
        var eventId = event.id;
        var startDate = event.start.toISOString().slice(0, 19).replace('T', ' ');
        var endDate = event.end ? event.end.toISOString().slice(0, 19).replace('T', ' ') : null;

        $.ajax({
            url: '{{ route("superAdmin.textsThemes.update")}}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                eventId:eventId,
                start_date: startDate,
                end_date: endDate,
                title: event.title, // Optional: update title if needed
                color: event.backgroundColor // Optional: update color if needed
            },
            success: function (response) {
                if (response.status === 'success') {
                    // Optional: handle success message or UI update
                    
                }
            }
        });
        }
      
    });
</script>
@endsection
