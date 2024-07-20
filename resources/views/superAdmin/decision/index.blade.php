@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
<div class="row mb-5 ml-2">
    @can('decision_create')
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#decision-primary">
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
                    <table  class="table table-bordered table-striped {{ count($decisions) > 0 ? 'datatable' : '' }} @can('decision_delete') dt-select @endcan">
                    <thead>
                    <tr>
                        @can('decision_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan
                        <th>@lang('quickadmin.decision.fields.libelle')</th>
                        <th>&nbsp;</th>

                    </tr>
                    </thead>
                    <tbody>
                        @if (count($decisions) > 0)
                            @foreach ($decisions as $item)
                                <tr data-entry-id="{{ $item->id }}">
                                    @can('decision_delete')
                                        <td></td>
                                    @endcan

                                    <td field-key='title'>{{ $item->libelle }}</td>
                                    <td class="d-flex">
                                    @can('decision_view')
                                        <button type="button" class="btn btn-xs btn-primary"   data-toggle="modal" data-target="#decision-default{{ $item->id }}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        @include("superAdmin.decision.action")
                                    @endcan
                                    @can('decision_edit')
                                        <button type="button" class="btn btn-xs btn-info"  data-toggle="modal" data-target="#decision-info{{ $item->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        @include("superAdmin.decision.action")
                                    
                                    @endcan

                                    @can('decision_delete')
                                        
                                        <button type="button" class="btn btn-xs btn-danger"  data-toggle="modal" data-target="#decision-danger{{ $item->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        @include("superAdmin.decision.action")
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



    @include("superAdmin.decision.modal")


 

@stop

@section('javascript') 
<script>
    @can('decision_access')
        window.route_mass_crud_entries_destroy = '{{ route('superAdmin.decision.mass_destroy') }}';
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