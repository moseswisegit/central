@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')


@section('style')
<style>
    .decision-span {
    padding: 2px 5px;
    border-radius: 3px;
    font-weight: bold;
}

.neutre {
    background-color: orange;
    color:white;
}

.approuver {
    background-color: green;
    color:white;
}

.refuser {
    background-color: red;
    color:white;

}

</style>

@endsection
@section('content')
<div class="row mb-5 ml-2">
    @can('paroisse_create')
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#paroisse-primary">
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
                    <table  class="table table-bordered table-striped {{ count($paroisses) > 0 ? 'datatable' : '' }} @can('paroisse_delete') dt-select @endcan">
                    <thead>
                    <tr>
                        @can('paroisse_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan
                        <th>@lang('quickadmin.paroisse.fields.chaine')</th>
                        <th>@lang('quickadmin.paroisse.fields.paroisse')</th>
                        <th>@lang('quickadmin.paroisse.fields.pays')</th>
                        <th>@lang('quickadmin.paroisse.fields.charge')</th>
                        {{-- <th>@lang('quickadmin.paroisse.fields.create_at')</th> --}}
                        <th>@lang('quickadmin.paroisse.fields.image')</th>
                        <th>@lang('quickadmin.paroisse.fields.decision')</th>
                        <th>@lang('quickadmin.paroisse.fields.message')</th>
                        <th>@lang('quickadmin.paroisse.fields.message')</th>

                        <th>&nbsp;</th>

                    </tr>
                    </thead>
                    <tbody>
                        @if (count($paroisses) > 0)
                            @foreach ($paroisses as $paroisse)
                                <tr data-entry-id="{{ $paroisse->id }}">
                                    @can('paroisse_delete')
                                        <td></td>
                                    @endcan
                                    <td field-key='chaine' >{{ $paroisse->chaine_paroisse }}</td>
                                    <td field-key='title' >{{ $paroisse->nom_paroisse }}</td>
                                    <td field-key='title'>{{ $paroisse->pays->libelle }}</td>
                                    <td field-key='title'>{{ $paroisse->nom_charge}}</td>
                                    {{-- <td field-key='title'>{{ $paroisse->created_at->format('Y-m-d') }}</td> --}}
                                    <td field-key='image'>
                                        <img src="{{ asset('storage/' . $paroisse->image_eglise) }}" alt="Image de l'église" style="max-width: 100px; max-height: 100px;">
                                    </td>

                                    <td field-key='decision'>
                                        <select name="decisions" id="decisions" data-paroisse-id="{{ $paroisse->id }}" onchange="confirmChange(this)">
                                            <option value="">Selectionner</option>
                                            @foreach ($decisions as $decision)
                                                <option value="{{ $decision->id }}" data-decision-id="{{ $decision->id }}"> {{ $decision->libelle }} </option>
                                            @endforeach
                                        </select>
                                        
                                        <span class="decision-span {{ strtolower($paroisse->decision) }}">{{ $paroisse->decision }}</span>
                                    </td>

                                    <td field-key='message'>
                                        <form action="{{ route("superAdmin.whatsapp.send")}}" method="post">
                                            @csrf
                                            <input type="hidden"  name="to" value="{{ $paroisse->numero_charge }}">
                                            <input type="hidden" name="paroisse_id" value="{{ $paroisse->id }}">
                                            <button type="submit" class="btn btn-block btn-primary btn-xs">Par whathsapp</button>
                                        </form>
                                    </td>

                                    <td field-key='message'>
                                        <form action="{{ route("superAdmin.sms.send")}}" method="post">
                                            @csrf
                                            <input type="hidden"  name="to" value="{{ $paroisse->numero_charge }}">
                                            <input type="hidden" name="paroisse_id" value="{{ $paroisse->id }}">
                                            <button type="submit" class="btn btn-block btn-primary btn-xs">Code par sms</button>
                                        </form>
                                    </td>
                                    
                                    <td class="d-flex">
                                    @can('paroisse_view')
                                        <button type="button" class="btn btn-xs btn-primary"   data-toggle="modal" data-target="#paroisse-default{{ $paroisse->id }}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        @include("superAdmin.paroisse.action")
                                    @endcan
                                    @can('paroisse_edit')
                                        <button type="button" class="btn btn-xs btn-info"  data-toggle="modal" data-target="#paroisse-info{{ $paroisse->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        @include("superAdmin.paroisse.action")
                                    
                                    @endcan

                                    @can('paroisse_delete')
                                        
                                        <button type="button" class="btn btn-xs btn-danger"  data-toggle="modal" data-target="#paroisse-danger{{ $paroisse->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        @include("superAdmin.paroisse.action")
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



    @include("superAdmin.paroisse.modal")


 

@stop

@section('javascript') 
<script>
    @can('paroisse_delete')
        window.route_mass_crud_entries_destroy = '{{ route('superAdmin.paroisse.mass_destroy') }}';
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
    function confirmChange(select) {
    var paroisseId = $(select).data('paroisse-id');
    var decisionId = $(select).find('option:selected').attr('data-decision-id');
    
    if (!decisionId || !paroisseId) {
        console.error('Decision ID or Paroisse ID is not found');
        return;
    }

    $('#confirmationModal').modal('show');
    
    $('#confirmButton').off('click').on('click', function() {
        $.ajax({
            url: '/superAdmin/changer-decision/' + paroisseId + '/' + decisionId,
            type: 'GET',
            success: function(response) {
                console.log("Changement de décision réussi");
                $('#confirmationModal').modal('hide');
                // Afficher le toast de succès
                $(document).Toasts('create', {
                    class: 'bg-success', 
                    title: 'Changement de décision',
                    autohide: true,
                    delay: 2000,
                    position: 'topRight',
                    body: 'La décision a été mise à jour avec succès.'
                });
                // Mettre à jour l'affichage ou d'autres actions nécessaires
                location.reload(); // Recharge la page pour voir les modifications
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
    }






</script>





@endsection