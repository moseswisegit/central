@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
<div class="row mb-5 ml-2">
    @can('categorie_create')
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#categorie-primary">
            @lang('quickuser.qa_add_new')
        </button>
    @endcan
</div>

    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-12">
                <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> @lang('quickuser.qa_list')</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <table  class="table table-bordered table-striped {{ count($categories) > 0 ? 'datatable' : '' }} @can('categorie_delete') dt-select @endcan">
                    <thead>
                    <tr>
                        @can('categorie_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan
                        <th>@lang('quickuser.categorie.fields.libelle')</th>
                        <th>&nbsp;</th>

                    </tr>
                    </thead>
                    <tbody>
                        @if (count($categories) > 0)
                            @foreach ($categories as $categorie)
                                <tr data-entry-id="{{ $categorie->id }}">
                                    @can('categorie_delete')
                                        <td></td>
                                    @endcan

                                    <td field-key='title'>{{ $categorie->libelle }}</td>
                                    <td class="d-flex">
                                    @can('role_view')
                                        <button type="button" class="btn btn-xs btn-primary"   data-toggle="modal" data-target="#role-default{{ $categorie->id }}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        @include("user.categorie.action")
                                    @endcan
                                    @can('categorie_edit')
                                        <button type="button" class="btn btn-xs btn-info"  data-toggle="modal" data-target="#categorie-info{{ $categorie->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        @include("user.categorie.action")
                                    
                                    @endcan

                                    @can('categorie_delete')
                                        
                                        <button type="button" class="btn btn-xs btn-danger"  data-toggle="modal" data-target="#categorie-danger{{ $categorie->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        @include("user.categorie.action")
                                    @endcan
                                                            
                                    </td>

                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="10">@lang('quickuser.qa_no_entries_in_table')</td>
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



    @include("user.categorie.modal")


 

@stop

@section('javascript') 
<script>
    @can('categorie_delete')
        window.route_mass_crud_entries_destroy = '{{ route('user.categorie.mass_destroy') }}';
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