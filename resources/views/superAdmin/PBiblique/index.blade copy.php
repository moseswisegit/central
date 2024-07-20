@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
<div class="row mb-5 ml-2">
    @can('pbiblique_create')
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pbiblique-primary">
            @lang('quickadmin.qa_add_new')
        </button>
    @endcan
</div>

    {{-- <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-12">
                <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> @lang('quickadmin.qa_list')</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <table  class="table table-bordered table-striped {{ count($pbiblique) > 0 ? 'datatable' : '' }} @can('pbiblique_delete') dt-select @endcan">
                    <thead>
                    <tr>
                        @can('pbiblique_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan
                        <th>@lang('quickadmin.pbiblique.fields.libelle')</th>
                        <th>&nbsp;</th>

                    </tr>
                    </thead>
                    <tbody>
                        @if (count($pbiblique) > 0)
                            @foreach ($pbiblique as $item)
                                <tr data-entry-id="{{ $item->id }}">
                                    @can('pbiblique_delete')
                                        <td></td>
                                    @endcan

                                    <td field-key='title'>{{ $item->libelle }}</td>
                                    <td class="d-flex">
                                    @can('pbiblique_view')
                                        <button type="button" class="btn btn-xs btn-primary"   data-toggle="modal" data-target="#pbiblique-default{{ $item->id }}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        @include("superAdmin.pbiblique.action")
                                    @endcan
                                    @can('pbiblique_edit')
                                        <button type="button" class="btn btn-xs btn-info"  data-toggle="modal" data-target="#pbiblique-info{{ $item->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        @include("superAdmin.pbiblique.action")
                                    
                                    @endcan

                                    @can('pbiblique_delete')
                                        
                                        <button type="button" class="btn btn-xs btn-danger"  data-toggle="modal" data-target="#pbiblique-danger{{ $item->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        @include("superAdmin.pbiblique.action")
                                    @endcan
                                                            
                                    </td>

                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="10">@lang('quickadmin.qa_no_entries_in_table')</td>
                            </tr>
                        @endif
                        </tbody>
                        
                    </table>
                </div>
                <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        <!-- /.col -->
        </div>
        <!-- /.row -->
    </div> --}}


      <!-- Main content -->
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
                      <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                        <!--<button type="button" id="color-chooser-btn" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">Color <span class="caret"></span></button>-->
                        <ul class="fc-color-picker" id="color-chooser">
                          <li><a class="text-primary" href="#"><i class="fas fa-square"></i></a></li>
                          <li><a class="text-warning" href="#"><i class="fas fa-square"></i></a></li>
                          <li><a class="text-success" href="#"><i class="fas fa-square"></i></a></li>
                          <li><a class="text-danger" href="#"><i class="fas fa-square"></i></a></li>
                          <li><a class="text-muted" href="#"><i class="fas fa-square"></i></a></li>
                        </ul>
                      </div>
                      <!-- /btn-group -->
                      <div class="input-group">
                        <label for="texteBiblique">Texte: </label>
                        <input id="texteBiblique" type="text" class="form-control" placeholder="Texte biblique">
                      </div>

                      <div class="input-group mt-3">
                        <label for="texteBiblique">Date: </label>
                        <input id="texteBiblique" type="text" class="form-control" placeholder="Texte biblique">
                      </div>
        

                      <div class="input-group mt-3">
                        <label for="texteBiblique">Heure: </label>
                        <input id="texteBiblique" type="text" class="form-control" placeholder="Texte biblique">
                      </div>

                      <button id="add-new-event" type="button" class="btn btn-primary">Add</button>

                    </div>
                </div>

                <!-- /.card -->
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Thème de la semaine</h3>
                  </div>
                  <div class="card-body">
                    <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                      <!--<button type="button" id="color-chooser-btn" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">Color <span class="caret"></span></button>-->
                      <ul class="fc-color-picker" id="color-chooser">
                        <li><a class="text-primary" href="#"><i class="fas fa-square"></i></a></li>
                        <li><a class="text-warning" href="#"><i class="fas fa-square"></i></a></li>
                        <li><a class="text-success" href="#"><i class="fas fa-square"></i></a></li>
                        <li><a class="text-danger" href="#"><i class="fas fa-square"></i></a></li>
                        <li><a class="text-muted" href="#"><i class="fas fa-square"></i></a></li>
                      </ul>
                    </div>
                    <!-- /btn-group -->
                    <div class="input-group mt-3">
                        <label for="texteBiblique">Theme: </label>
                        <input id="texteBiblique" type="text" class="form-control" placeholder="Texte biblique">
                      </div>
        

                      <div class="input-group mt-3">
                        <label for="texteBiblique">Date(plage semaine): </label>
                        <input id="texteBiblique" type="text" class="form-control" placeholder="Texte biblique">
                      </div>

                      <button id="add-new-event" type="button" class="btn btn-primary">Add</button>
                    <!-- /input-group -->
                  </div>
                </div>

               


              </div>
            </div>
            <!-- /.col -->
            <div class="col-md-9">
              <div class="card card-primary">
                <div class="card-body p-0">
                  <!-- THE CALENDAR -->
                  <div id="calendar"></div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->


    @include("superAdmin.pbiblique.modal")


 

@stop

@section('javascript') 
<script>
    @can('pbiblique_access')
        window.route_mass_crud_entries_destroy = '{{ route('superAdmin.pbiblique.mass_destroy') }}';
    @endcan

</script>


<script>
    @if(session('success'))
        Toast.fire({
            icon: 'success',
            title: '{{ session('success') }}'
        });
    @endif
</script>


<script>
    $(function () {
  
      /* initialize the external events
       -----------------------------------------------------------------*/
      function ini_events(ele) {
        ele.each(function () {
  
          // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
          // it doesn't need to have a start or end
          var eventObject = {
            title: $.trim($(this).text()) // use the element's text as the event title
          }
  
          // store the Event Object in the DOM element so we can get to it later
          $(this).data('eventObject', eventObject)
  
          // make the event draggable using jQuery UI
          $(this).draggable({
            zIndex        : 1070,
            revert        : true, // will cause the event to go back to its
            revertDuration: 0  //  original position after the drag
          })
  
        })
      }
  
    //   ini_events($('#external-events div.external-event'))
  
      /* initialize the calendar
       -----------------------------------------------------------------*/
      //Date for the calendar events (dummy data)
      var date = new Date()
      var d    = date.getDate(),
          m    = date.getMonth(),
          y    = date.getFullYear()
  
      var Calendar = FullCalendar.Calendar;
      var Draggable = FullCalendarInteraction.Draggable;
  
    //   var containerEl = document.getElementById('external-events');
      var checkbox = document.getElementById('drop-remove');
      var calendarEl = document.getElementById('calendar');
  
      // initialize the external events
      // -----------------------------------------------------------------
  
    //   new Draggable(containerEl, {
    //     itemSelector: '.external-event',
    //     eventData: function(eventEl) {
    //       console.log(eventEl);
    //       return {
    //         title: eventEl.innerText,
    //         backgroundColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
    //         borderColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
    //         textColor: window.getComputedStyle( eventEl ,null).getPropertyValue('color'),
    //       };
    //     }
    //   });
  
      var calendar = new Calendar(calendarEl, {
        plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid' ],
        header    : {
          left  : 'prev,next today',
          center: 'title',
          right : 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        'themeSystem': 'bootstrap',
        //Random default events
        events    : [
          {
            title          : 'All Day Event',
            start          : new Date(y, m, 1),
            backgroundColor: '#f56954', //red
            borderColor    : '#f56954', //red
            allDay         : true
          },
          {
            title          : 'Long Event',
            start          : new Date(y, m, d - 5),
            end            : new Date(y, m, d - 2),
            backgroundColor: '#f39c12', //yellow
            borderColor    : '#f39c12' //yellow
          },
          {
            title          : 'Meeting',
            start          : new Date(y, m, d, 10, 30),
            allDay         : false,
            backgroundColor: '#0073b7', //Blue
            borderColor    : '#0073b7' //Blue
          },
          {
            title          : 'Lunch',
            start          : new Date(y, m, d, 12, 0),
            end            : new Date(y, m, d, 14, 0),
            allDay         : false,
            backgroundColor: '#00c0ef', //Info (aqua)
            borderColor    : '#00c0ef' //Info (aqua)
          },
          {
            title          : 'Birthday Party',
            start          : new Date(y, m, d + 1, 19, 0),
            end            : new Date(y, m, d + 1, 22, 30),
            allDay         : false,
            backgroundColor: '#00a65a', //Success (green)
            borderColor    : '#00a65a' //Success (green)
          },
          {
            title          : 'Click for Google',
            start          : new Date(y, m, 28),
            end            : new Date(y, m, 29),
            url            : 'http://google.com/',
            backgroundColor: '#3c8dbc', //Primary (light-blue)
            borderColor    : '#3c8dbc' //Primary (light-blue)
          }
        ],
        editable  : true,
        droppable : true, // this allows things to be dropped onto the calendar !!!
        drop      : function(info) {
          // is the "remove after drop" checkbox checked?
          if (checkbox.checked) {
            // if so, remove the element from the "Draggable Events" list
            info.draggedEl.parentNode.removeChild(info.draggedEl);
          }
        }    
      });
  
      calendar.render();
      // $('#calendar').fullCalendar()
  
      /* ADDING EVENTS */
      var currColor = '#3c8dbc' //Red by default
      //Color chooser button
      var colorChooser = $('#color-chooser-btn')
      $('#color-chooser > li > a').click(function (e) {
        e.preventDefault()
        //Save color
        currColor = $(this).css('color')
        //Add color effect to button
        $('#add-new-event').css({
          'background-color': currColor,
          'border-color'    : currColor
        })
      })
      $('#add-new-event').click(function (e) {
        e.preventDefault()
        //Get value and make sure it is not null
        var val = $('#new-event').val()
        if (val.length == 0) {
          return
        }
  
        //Create events
        var event = $('<div />')
        event.css({
          'background-color': currColor,
          'border-color'    : currColor,
          'color'           : '#fff'
        }).addClass('external-event')
        event.html(val)
        // $('#external-events').prepend(event)
  
        //Add draggable funtionality
        ini_events(event)
  
        //Remove event from text input
        $('#new-event').val('')
      })
    })
  </script>






@endsection