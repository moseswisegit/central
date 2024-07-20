@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
<div class="row mb-5 ml-2">
    @can('pays_create')
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pays-primary">
            @lang('quickadmin.qa_add_new')
        </button>
    @endcan
</div>

    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-12">
                <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> @lang('quickadmin.qa_list')</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <table  class="table table-bordered table-striped {{ count($pays) > 0 ? 'datatable' : '' }} @can('pays_delete') dt-select @endcan">
                    <thead>
                    <tr>
                        @can('pays_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan
                        <th>@lang('quickadmin.pays.fields.libelle')</th>
                        <th>&nbsp;</th>

                    </tr>
                    </thead>
                    <tbody>
                        @if (count($pays) > 0)
                            @foreach ($pays as $item)
                                <tr data-entry-id="{{ $item->id }}">
                                    @can('pays_delete')
                                        <td></td>
                                    @endcan

                                    <td field-key='title'>{{ $item->libelle }}</td>
                                    <td class="d-flex">
                                    @can('pays_view')
                                        <button type="button" class="btn btn-xs btn-primary"   data-toggle="modal" data-target="#pays-default{{ $item->id }}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        @include("superAdmin.pays.action")
                                    @endcan
                                    @can('pays_edit')
                                        <button type="button" class="btn btn-xs btn-info"  data-toggle="modal" data-target="#pays-info{{ $item->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        @include("superAdmin.pays.action")
                                    
                                    @endcan

                                    @can('pays_delete')
                                        
                                        <button type="button" class="btn btn-xs btn-danger"  data-toggle="modal" data-target="#pays-danger{{ $item->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        @include("superAdmin.pays.action")
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
    </div>



    @include("superAdmin.pays.modal")


 

@stop

@section('javascript') 
<script>
    @can('pays_access')
        window.route_mass_crud_entries_destroy = '{{ route('superAdmin.pays.mass_destroy') }}';
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






@endsection