@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
<div class="row mb-5 ml-2">
    @can('role_create')
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-primary">
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
            <table  class="table table-bordered table-striped {{ count($roles) > 0 ? 'datatable' : '' }} @can('role_delete') dt-select @endcan">
              <thead>
              <tr>
                @can('role_delete')
                    <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                @endcan
                <th>@lang('quickadmin.roles.fields.title')</th>
                <th>&nbsp;</th>

              </tr>
              </thead>
              <tbody>
                @if (count($roles) > 0)
                    @foreach ($roles as $role)
                        <tr data-entry-id="{{ $role->id }}">
                            @can('role_delete')
                                <td></td>
                            @endcan

                            <td field-key='title'>{{ $role->title }}</td>
                            <td class="d-flex">
                            @can('role_view')
                                <button type="button" class="btn btn-xs btn-primary"   data-toggle="modal" data-target="#role-default{{ $role->id }}">
                                    <i class="fas fa-eye"></i>
                                </button>
                                @include("superAdmin.roles.action")
                            @endcan
                            @can('role_edit')
                                <button type="button" class="btn btn-xs btn-info"  data-toggle="modal" data-target="#role-info{{ $role->id }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                @include("superAdmin.roles.action")
                               
                            @endcan

                            @if (Auth::user()->id != 1)
                            @can('role_delete')
                            <button type="button" class="btn btn-xs btn-danger"  data-toggle="modal" data-target="#role-danger{{ $role->id }}">
                                <i class="fas fa-trash"></i>
                            </button>
                            @include("superAdmin.roles.action")
                            @endcan
                            @endif
                            
                                                    
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



    @include("superAdmin.roles.modal")


 

@stop

@section('javascript') 
<script>
    @can('role_delete')
        window.route_mass_crud_entries_destroy = '{{ route('superAdmin.roles.mass_destroy') }}';
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