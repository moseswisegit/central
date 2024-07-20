<script>
    window.deleteButtonTrans = '{{ trans("quickadmin.qa_delete_selected") }}';
    window.copyButtonTrans = '{{ trans("quickadmin.qa_copy") }}';
    window.csvButtonTrans = '{{ trans("quickadmin.qa_csv") }}';
    window.excelButtonTrans = '{{ trans("quickadmin.qa_excel") }}';
    window.pdfButtonTrans = '{{ trans("quickadmin.qa_pdf") }}';
    window.printButtonTrans = '{{ trans("quickadmin.qa_print") }}';
    window.colvisButtonTrans = '{{ trans("quickadmin.qa_colvis") }}';
</script>

<!-- jQuery -->
<script src="{{ asset('AdminLTE3/plugins/jquery/jquery.min.js')}}"></script>

<!-- Bootstrap 4 -->
<script src="{{ asset('AdminLTE3/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<script src="{{ asset('AdminLTE3/plugins/jquery-ui/jquery-ui.min.js')}}"></script>

<!-- AdminLTE App -->
<script src="{{ asset('AdminLTE3/dist/js/adminlte.min.js')}}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{ asset('AdminLTE3/dist/js/demo.js')}}"></script>

<script src="{{ asset('AdminLTE3/plugins/ekko-lightbox/ekko-lightbox.min.js')}}"></script>

<!-- SweetAlert2 -->
<script src="{{ asset('AdminLTE3/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<!-- Toastr -->
<script src="{{ asset('AdminLTE3/plugins/toastr/toastr.min.js')}}"></script>

<script src="{{ url('adminlte/js') }}/main.js"></script>

<!-- DataTables -->
<script src="{{ asset('AdminLTE3/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('AdminLTE3/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('AdminLTE3/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('AdminLTE3/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ asset('js/dataTables.select.min.js')}}"></script>
<script src="{{ asset('AdminLTE3/plugins/select2/js/select2.full.min.js')}}"></script>

{{-- <script src="{{ url('adminlte/js') }}/select2.full.min.js"></script> --}}
<script src="{{ url('adminlte/js') }}/main.js"></script>
<!-- Summernote -->
<script src="{{ asset('AdminLTE3/plugins/summernote/summernote-bs4.min.js')}}"></script>
<script src="{{ asset('js/summernote-ext-print.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>


<script>
    $(function () {
      $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox({
          alwaysShowClose: true
        });
      });
    })
  </script>


<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  })
</script>















 {{-- <script src="//code.jquery.com/jquery-1.11.3.min.js"></script> --}}
{{-- <script src="//cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script> --}}
{{-- <script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script> 
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script> --}}
{{-- <script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script> --}}
{{-- <script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>  --}}
 {{-- <script src="{{ url('adminlte/js') }}/bootstrap.min.js"></script> --}}
{{-- <script src="{{ url('adminlte/js') }}/select2.full.min.js"></script>
<script src="{{ url('adminlte/js') }}/main.js"></script> --}}
{{-- 
<script src="{{ url('adminlte/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/fastclick/fastclick.js') }}"></script>
<script src="{{ url('adminlte/js/app.min.js') }}"></script>  --}}
<script>
    window._token = '{{ csrf_token() }}';
</script>
<script>
    $.extend(true, $.fn.dataTable.defaults, {
        "language": {
            "url": "http://cdn.datatables.net/plug-ins/1.10.16/i18n/English.json"
        }
    });
</script>

 {{-- alert --}}
 <script>
  const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 4000
  });
</script>

<!-- fullCalendar 2.2.5 -->
<script src="{{ asset('AdminLTE3/plugins/moment/moment.min.js')}}"></script>
<script src="{{ asset('AdminLTE3/plugins/fullcalendar/main.min.js')}}"></script>
<script src="{{ asset('AdminLTE3/plugins/fullcalendar-daygrid/main.min.js')}}"></script>
<script src="{{ asset('AdminLTE3/plugins/fullcalendar-timegrid/main.min.js')}}"></script>
<script src="{{ asset('AdminLTE3/plugins/fullcalendar-interaction/main.min.js')}}"></script>
<script src="{{ asset('AdminLTE3/plugins/fullcalendar-bootstrap/main.min.js')}}"></script>


@yield('javascript')