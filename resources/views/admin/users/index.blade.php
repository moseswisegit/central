@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')

<div class="row mb-5 ml-2">
    @can('user_create')
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-primary">
            @lang('quickadmin.qa_add_new')
        </button>
    @endcan
</div>
   

    <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> @lang('quickadmin.qa_list')</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive">
            <table  class="table table-bordered table-striped {{ count($users) > 0 ? 'datatable' : '' }} @can('user_delete') dt-select @endcan">
              <thead>
              <tr>
                @can('user_delete')
                    <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                @endcan
                <th>@lang('quickadmin.users.fields.name')</th>
                <th>@lang('quickadmin.users.fields.email')</th>
                <th>@lang('quickadmin.users.fields.role')</th>
                <th>&nbsp;</th>
              </tr>
              </thead>
              <tbody>
                @if (count($users) > 0)
                    @foreach ($users as $user)
                        <tr data-entry-id="{{ $user->id }}">
                            @can('user_delete')
                                <td></td>
                            @endcan

                            <td field-key='name'>{{ $user->name }}</td>
                            <td field-key='email'>{{ $user->email }}</td>
                            <td field-key='role'>{{ $user->role->title or '' }}</td>
                            <td class="d-flex">
                            @can('user_view')
                                <button type="button" class="btn btn-xs btn-primary" data-user-id="{{ $user->id }}"  data-toggle="modal" data-target="#modal-default{{ $user->id }}">
                                    <i class="fas fa-eye"></i>
                                </button>
                                @include("superAdmin.users.action")
                                {{-- <a href="{{ route('admin.users.show',[$user->id]) }}" class="btn btn-xs btn-primary">
                                    <i class="fas fa-eye"></i>
                                </a> --}}
                            @endcan
                            @can('user_edit')
                                <button type="button" class="btn btn-xs btn-info" data-user-id="{{ $user->id }}"  data-toggle="modal" data-target="#modal-info{{ $user->id }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                @include("superAdmin.users.action")
                               
                            @endcan

                            @can('user_delete')
                                
                                <button type="button" class="btn btn-xs btn-danger " data-user-id="{{ $user->id }}"  data-toggle="modal" data-target="#modal-danger{{ $user->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                                @include("superAdmin.users.action")


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



    @include("superAdmin.users.modal")


 

@stop

@section('javascript') 
    <script>
        @can('user_delete')
            window.route_mass_crud_entries_destroy = '{{ route('superAdmin.users.mass_destroy') }}';
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