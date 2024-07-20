@inject('request', 'Illuminate\Http\Request')

@extends('layouts.app')

@section('content')
<div class="row offset-md-10">
    @can('produits_create')
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg">
            @lang('quickuser.qa_add_new')
        </button>
    @endcan
</div>

<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">@lang('quickuser.qa_list')</h3>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-striped {{ count($produits) > 0 ? 'datatable' : '' }} @can('produits_delete') dt-select @endcan">
                        <thead>
                            <tr>
                                @can('produits_delete')
                                    <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                                @endcan
                                <th>@lang('quickuser.produits.fields.libelle')</th>
                                <th>@lang('quickuser.produits.fields.qte_command')</th>
                                <th>@lang('quickuser.produits.fields.qte_recu')</th>
                                <th>@lang('quickuser.produits.fields.prix_unitaire')</th>
                                <th>@lang('quickuser.produits.fields.montant')</th>
                                <th>@lang('quickuser.produits.fields.categorie_id')</th>
                                <th>@lang('quickuser.produits.fields.fournisseur_id')</th>
                                {{-- <th>@lang('quickuser.produits.fields.date_livraison')</th>
                                <th>@lang('quickuser.produits.fields.etat_livraison')</th> --}}
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($produits as $produit)
                                <tr data-entry-id="{{ $produit->id }}">
                                    @can('produits_delete')
                                        <td></td>
                                    @endcan
                                    <td field-key='libelle'>{{ $produit->designation }}</td>
                                    <td field-key='qte_command'>{{ $produit->qte_command }}</td>
                                    <td field-key='qte_recu'>{{ $produit->qte_recu }}</td>
                                    <td field-key='prix_unitaire'>{{ $produit->prix_unitaire }}</td>
                                    <td field-key='montant'>{{ $produit->montant }}</td>
                                    <td field-key='categorie_id'>{{ $produit->categorie->libelle }}</td>
                                    <td field-key='fournisseur_id'>{{ $produit->fournisseur->libelle }}</td>
                                    {{-- <td field-key='date_livraison'>{{ $produit->date_livraison }}</td>
                                    <td field-key='etat_livraison'>{{ $produit->etat_livraison }}</td> --}}
                                    <td class="d-flex">
                                        @can('produits_view')
                                            <button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#produits-default{{ $produit->id }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        @endcan
                                        @can('produits_edit')
                                            <button type="button" class="btn btn-xs btn-info" data-toggle="modal" data-target="#produits-info{{ $produit->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        @endcan
                                        @can('produits_delete')
                                            <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#produits-danger{{ $produit->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        @endcan
                                        @include("user.produits.action")
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11">@lang('quickuser.qa_no_entries_in_table')</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include("user.produits.modal")
@stop

@section('javascript')
<script>
    @can('produits_delete')
        window.route_mass_crud_entries_destroy = '{{ route('user.produits.mass_destroy') }}';
    @endcan

    @if(session('success'))
        Toast.fire({
            icon: 'success',
            title: '{{ session('success') }}'
        });
    @endif

    function calculateMontant() {
        var qteRecu = parseInt(document.getElementById('qte_recu').value, 10);
        var prixUnitaire = parseFloat(document.getElementById('prix_unitaire').value);
        var montant = qteRecu * prixUnitaire;
        document.getElementById('montant').value = montant.toFixed(2);
    }

    function verifierQuantite() {
        var quantiteCommandee = parseInt(document.getElementById('qte_command').value, 10);
        var quantiteRecue = parseInt(document.getElementById('qte_recu').value, 10);
        if (quantiteRecue > quantiteCommandee) {
            alert("La quantité reçue est supérieure à la quantité commandée. Veuillez vérifier.");
        }

    }

    function enregistrerCategorie() {
        var formData = $("#categorieForm").serialize();

        $.ajax({
            type: "POST",
            url: "{{ route('user.categorie.store') }}",
            data: formData,
            success: function(response) {
                $('#categorie-sm').modal('hide');
                mettreAJourSelectCategorie();
                $('#libelle').val('');
                $(document).Toasts('create', {
                    class: 'bg-success', 
                    title: 'Ajout d\'une nouvelle catégorie',
                    autohide: true,
                    delay: 1550,
                    position: 'topLeft',
                    body: 'Insertion réussi avec succès'
                })
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function mettreAJourSelectCategorie() {
        $.ajax({
            type: "GET",
            url: "{{ route('user.obtenir.categories') }}",
            success: function(categories) {
                var select = $("select[name='categorie_id']");
                select.empty();

                $.each(categories, function(index, categorie) {
                    select.append('<option value="' + categorie.id + '">' + categorie.libelle + '</option>');
                });
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function enregistrerFournisseur() {
    var formData = $("#fournisseurForm").serialize();

    $.ajax({
        type: "POST",
        url: "{{ route('user.fournisseur.store') }}",
        data: formData,
        success: function(response) {
            // Fermer le modal après l'insertion réussie
            $('#fournisseur-sm').modal('hide');

            // Effacer les valeurs des champs libelle et adresse
            $('#fournisseurForm input[name="libelle"]').val('');
            $('#fournisseurForm input[name="adresse"]').val('');

            mettreAJourSelectFournisseur();

            $(document).Toasts('create', {
                class: 'bg-success',
                title: 'Ajout d\'un nouveau fournisseur',
                autohide: true,
                delay: 1550,
                position: 'topLeft',
                body: 'Insertion réussie avec succès'
            });
        },
        error: function(error) {
            console.log(error);
        }
    });
}


function mettreAJourSelectFournisseur() {
    $.ajax({
        type: "GET",
        url: "{{ route('user.obtenir.fournisseur') }}",
        success: function(fournisseurs) {
            var select = $("select[name='fournisseur_id']");
            select.empty();

            $.each(fournisseurs, function(index, fournisseur) {
                select.append('<option value="' + fournisseur.id + '">' + fournisseur.libelle + '</option>');
            });
        },
        error: function(error) {
            console.log(error);
        }
    });
}

</script>
@endsection
