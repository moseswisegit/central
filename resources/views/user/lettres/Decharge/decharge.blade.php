@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('style')
{{-- <link rel="stylesheet" href="{{ asset('css/lettres.css')}}"> --}}
@endsection
@section('content')
<div class="row mb-5 ml-2">

    <div class="col-md-4">
         <!-- /.col -->
        
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Mes lettres</h3>
                <div class="card-tools">
                    

                <button type="button" class="btn btn-tool" data-card-widget="maximize" onclick="toggleTable()"><i class="fas fa-expand"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                
                </div>
                <!-- /.card-tools -->
            </div>
            
            
          <!-- /.card-header -->
            <div class="row card-body">          
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>
    
                    <div class="info-box-content">
                    <span class="info-box-text text-center">Nombre de lettres générés</span>
                    <span class="info-box-number text-center">13,648</span>
                    </div>
                    <!-- /.info-box-content -->        
                </div>

                <div class="row col-md-2">
                    @can('fournisseur_create')
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#decharge-primary">
                        @lang('quickuser.qa_add_new')
                    </button>
                    @endcan
                </div>

                    @php
                        $pdfs  = app\Http\Controllers\User\LettresController::getUserFiles();
                    @endphp
                <div id="tableContainer" style="display: none;">
                    <!-- Contenu du tableau à afficher -->
                    <!-- /.col -->
                    
                    <div class="row">
                        <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Simple Full Width Table</h3>

                            <div class="card-tools">
                            <ul class="pagination pagination-sm float-right">
                               
                            </ul>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0 table-responsive">
                            <table id="tablePdf" class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nom du fichier</th>
                                        <th>Date de génération</th>
                                        <th>Description</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pdfs as $index => $file)
                                        @php
                                            // Utiliser parse_url pour obtenir le chemin de l'URL
                                            $path = parse_url($file->url, PHP_URL_PATH);
                                            // Utiliser basename pour obtenir le nom du fichier à partir du chemin
                                            $name = basename($path);
                                        @endphp
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $name }}</td>
                                        <td>{{ $file->created_at }}</td>
                                        <td> Décharge effectué pour {{ $file->nom_receveur }}</td>
                                        <td>
                                            <button type="button" class="btn btn-info" onclick="previewFile('{{ $file->url }}')">Prévisualiser</button>
                                            <a href="{{ $file->url }}" class="btn btn-primary" download>Télécharger</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                            
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card --> 
                </div>
                   
            </div>
           
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    
    <div class="col-md-8">
        @if(isset($envoie))
            <div class="float-right">
                <button id="telechargerPDF" class="btn btn-primary">Télécharger en PDF</button>
            </div>
            <div class="row container" style="max-width: 800px; margin: 0 auto;">
                <div id="lettrededecharg" style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
                border: 1px solid #ccc;
                padding: 20px;
                background-color: #fff;
                line-height: 1.6; text-align: justify;">
                
                    <!-- Logo de la société -->
                    <div id="entete" style="display: flex; justify-content: space-between; align-items: center;">
                        <span id="logo" style="background-color: red; color: white; padding: 10px; font-size: 24px; font-weight: bold; max-width: 200px; overflow: hidden; text-overflow: ellipsis; text-align: left;">FMMCI</span>
                        <div id="ville-date" style="text-align: right;">Fait à Cocody le 2024-04-10</div>
                    </div>
                    

                    <div class="clearfix"></div>

                    <!-- Contenu de la lettre de décharge -->
                    <div id="contenu" style="margin-top: 50px; text-align: justify;">
                        <h2 style="text-align: center; margin-bottom: 20px;">Décharge</h2>
                        <p>Je soussigné {{$nom_receveur}} certifie avoir reçu de la  {{ $nom_donneur}}
                            une somme en liquide de <span id="montant">{{ $montant}} FCFA</span>
                            pour <span id="service"> {{ $motif}} </span>.
                        </p>
                        <p>
                            Pour servir et valoir ce que de droit.
                        </p>
                        <p>
                            Fait à Cocody en 2 exemplaires dont un remis à chaque partie.
                        </p>
                        <p>
                            Le  {{ date('d-m-Y')}}.
                        </p>
                    </div>

                <!-- Signatures -->
                    <div style="margin-top: 20px; text-align: justify;">
                        <div style="text-align: left; display: inline-block;">Signature: ........................ <br> (Signature de  {{ $nom_donneur}}) </div>

                        <div style="text-align: right; display: inline-block; width: 70%;">Signature: ......................... <br> (Signature de {{$nom_receveur}})</div>
                    </div>

                </div>

            </div>
            <input  id="url" type="hidden" value="{{ $url }}">     
        @endif   
    </div>

</div>




@include("user.lettres.Decharge.modal")

@stop

@section('javascript')
<!-- TCPDF -->
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

<script>
    $('#lettrededecharg').summernote({
        lang: 'fr',
        placeholder: 'Hello stand alone ui',
        tabsize: 2,
        height: 420,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']],
        ],
    });

    

    $(document).ready(function(){

    $('#telechargerPDF').click(function() {
        var contentData = $('#lettrededecharg').summernote('code'); // Obtenir le contenu mis à jour depuis Summernote
        var url = $('#url').val(); // Obtenir l'URL à partir du champ caché

        $.ajax({
            type: "POST",
            url: "{{ route('user.generate.pdf') }}",
            data: {
                _token: '{{ csrf_token() }}',
                content: contentData,
                url: url // Inclure l'URL dans les données de la requête
            },
            success: function(response) {
                // Télécharger le fichier PDF en utilisant la méthode downloadPDF
                window.open("{{ route('user.download.pdf', ':fileName') }}".replace(':fileName', response.file_name), '_blank');
                // Rediriger vers la page user/lettres
                window.location.href = "{{ route('user.decharge.index') }}";
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
});




</script>

<script>
    function toggleTable() {
        var tableContainer = document.getElementById('tableContainer');
        if (tableContainer.style.display === 'none') {
            tableContainer.style.display = 'block';
        } else {
            tableContainer.style.display = 'none';
        }
    }
</script>

<script>
    function previewFile(fileUrl) {
        // Vérifier le type de fichier pour les prévisualisations
        if (fileUrl.endsWith('.pdf')) {
            // Ouvrir le fichier PDF dans une nouvelle fenêtre
            window.open(fileUrl, '_blank');
        } else if (fileUrl.endsWith('.jpg') || fileUrl.endsWith('.jpeg') || fileUrl.endsWith('.png')) {
            // Afficher l'image dans une boîte modale ou une lightbox
            // Tu peux utiliser une librairie comme Bootstrap Modal pour cela
            // Exemple d'utilisation avec Bootstrap Modal :
            $('#previewModal').find('.modal-body').html(`<img src="${fileUrl}" class="img-fluid" alt="Prévisualisation">`);
            $('#previewModal').modal('show');
        } else {
            alert('Le type de fichier n\'est pas pris en charge pour la prévisualisation.');
        }
    }
</script>

<script>
    $(function () {
      $("#tablePdf").DataTable({
        "responsive": true,
        "autoWidth": false,
      });
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>


@endsection
