@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
<div class="row mb-5 ml-2">
    @can('quartier_create')
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#quartier-primary">
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
                    <table  class="table table-bordered table-striped {{ count($quartier) > 0 ? 'datatable' : '' }} @can('quartier_delete') dt-select @endcan">
                    <thead>
                    <tr>
                        @can('quartier_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan
                        <th>@lang('quickadmin.quartier.fields.libelle')</th>
                        <th>Commune</th>
                        <th>&nbsp;</th>

                    </tr>
                    </thead>
                    <tbody>
                        @if (count($quartier) > 0)
                            @foreach ($quartier as $item)
                                <tr data-entry-id="{{ $item->id }}">
                                    @can('quartier_delete')
                                        <td></td>
                                    @endcan

                                    <td field-key='title'>{{ $item->libelle }}</td>
                                    <td field-key='commune'>{{ $item->commune->libelle }}</td>

                                    <td class="d-flex">
                                    @can('quartier_view')
                                        <button type="button" class="btn btn-xs btn-primary"   data-toggle="modal" data-target="#quartier-default{{ $item->id }}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        @include("superAdmin.quartier.action")
                                    @endcan
                                    @can('quartier_edit')
                                        <button type="button" class="btn btn-xs btn-info"  data-toggle="modal" data-target="#quartier-info{{ $item->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        @include("superAdmin.quartier.action")
                                    
                                    @endcan

                                    @can('quartier_delete')
                                        
                                        <button type="button" class="btn btn-xs btn-danger"  data-toggle="modal" data-target="#quartier-danger{{ $item->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        @include("superAdmin.quartier.action")
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



    @include("superAdmin.quartier.modal")


 

@stop

@section('javascript') 
<script>
    @can('quartier_access')
        window.route_mass_crud_entries_destroy = '{{ route('superAdmin.quartier.mass_destroy') }}';
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