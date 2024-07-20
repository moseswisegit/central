@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
<div class="row mb-5 ml-2">
    @can('fournisseur_create')
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#fournisseur-primary">
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
                    <table  class="table table-bordered table-striped {{ count($fournisseurs) > 0 ? 'datatable' : '' }} @can('fournisseur_delete') dt-select @endcan">
                    <thead>
                    <tr>
                        @can('fournisseur_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan
                        <th>@lang('quickuser.fournisseur.fields.libelle')</th>
                        <th>@lang('quickuser.fournisseur.fields.adresse')</th>
                        <th>&nbsp;</th>

                    </tr>
                    </thead>
                    <tbody>
                        @if (count($fournisseurs) > 0)
                            @foreach ($fournisseurs as $fournisseur)
                                <tr data-entry-id="{{ $fournisseur->id }}">
                                    @can('fournisseur_delete')
                                        <td></td>
                                    @endcan

                                    <td field-key='title'>{{ $fournisseur->libelle }}</td>
                                    <td field-key='adresse'>{{ $fournisseur->adresse }}</td>

                                    <td class="d-flex">
                                    @can('role_view')
                                        <button type="button" class="btn btn-xs btn-primary"   data-toggle="modal" data-target="#role-default{{ $fournisseur->id }}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        @include("user.fournisseur.action")
                                    @endcan
                                    @can('fournisseur_edit')
                                        <button type="button" class="btn btn-xs btn-info"  data-toggle="modal" data-target="#fournisseur-info{{ $fournisseur->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        @include("user.fournisseur.action")
                                    
                                    @endcan

                                    @can('fournisseur_delete')
                                        
                                        <button type="button" class="btn btn-xs btn-danger"  data-toggle="modal" data-target="#fournisseur-danger{{ $fournisseur->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        @include("user.fournisseur.action")
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



    @include("user.fournisseur.modal")


 

@stop

@section('javascript') 
<script>
    @can('fournisseur_delete')
        window.route_mass_crud_entries_destroy = '{{ route('user.fournisseur.mass_destroy') }}';
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