@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
<div class="row mb-5 ml-2">
    @can('ville_create')
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ville-primary">
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
                    <table  class="table table-bordered table-striped {{ count($ville) > 0 ? 'datatable' : '' }} @can('ville_delete') dt-select @endcan">
                    <thead>
                    <tr>
                        @can('ville_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan
                        <th>@lang('quickadmin.ville.fields.libelle')</th>
                        <th>Pays</th>
                        <th>&nbsp;</th>

                    </tr>
                    </thead>
                    <tbody>
                        @if (count($ville) > 0)
                            @foreach ($ville as $item)
                                <tr data-entry-id="{{ $item->id }}">
                                    @can('ville_delete')
                                        <td></td>
                                    @endcan

                                    
                                    <td field-key='title'>{{ $item->libelle }}</td>
                                    <td field-key='pays'>{{ $item->pays->libelle }}</td>
                                    <td class="d-flex">
                                    @can('ville_view')
                                        <button type="button" class="btn btn-xs btn-primary"   data-toggle="modal" data-target="#ville-default{{ $item->id }}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        @include("superAdmin.ville.action")
                                    @endcan
                                    @can('ville_edit')
                                        <button type="button" class="btn btn-xs btn-info"  data-toggle="modal" data-target="#ville-info{{ $item->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        @include("superAdmin.ville.action")
                                    
                                    @endcan

                                    @can('ville_delete')
                                        
                                        <button type="button" class="btn btn-xs btn-danger"  data-toggle="modal" data-target="#ville-danger{{ $item->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        @include("superAdmin.ville.action")
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



    @include("superAdmin.ville.modal")


 

@stop

@section('javascript') 
<script>
    @can('ville_access')
        window.route_mass_crud_entries_destroy = '{{ route('superAdmin.ville.mass_destroy') }}';
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