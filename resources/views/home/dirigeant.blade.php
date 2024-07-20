@extends('layouts.accueil')

@section('css')
 <!-- Script pour charger l'API Google Maps -->
<link rel="stylesheet" href="{{asset('Accueil/assets/css/stylesStep.css')}}">
<link rel="stylesheet" href="{{ asset('Accueil/leaflet/leaflet.css')}}">
<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="{{ asset('Accueil/leaflet/leaflet.js')}}"></script>
<script src="{{ asset('js/ajax.js')}}"></script>
<style>
    .hidden {
        display: none;
    }

    #map {
        height: 400px;
        flex: 1;
    }

    .phone-number-container {
    display: flex;
    align-items: center;
}

.phone-number-container input[type="text"] {
    width: 60px; /* Ajustez la largeur selon vos besoins */
    margin-right: 5px;
}

.phone-number-container input[type="number"] {
    flex: 1;
}

</style>

@endsection

@section('content')

<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

      <ol>
        <li><a href="index.html">Home</a></li>
        <li>Services</li>
      </ol>
      <h2>Services</h2>

      

    </div>
  </section><!-- End Breadcrumbs -->

  <div class="col-md-4 offset-md-4 alert alert-primary text-center" role="alert">
   Veullez suivre cette étape pour inscrire votre paroisse 
  </div>

  <div class="row col-md-8 offset-md-2">
    <form id="paroisseForm" action="{{ route('enregistrerParoisse')}}" method="post" enctype="multipart/form-data" autocomplete="off">
        @csrf
        <h1 align="center">Informations sur la Paroisse</h1>
    
        <div style="text-align:center;">
            <span class="step" id="step-1">1</span>
            <span class="step" id="step-2">2</span>
            <span class="step" id="step-3">3</span>
            {{-- <span class="step" id="step-4">4</span> --}}
        </div>
    
        <div class="tab" id="tab-1">
            <div class="row">
                <div class="col-md-6">
                    <p>Nom de la paroisse:</p>
                    <input type="text" placeholder="Nom de la paroisse" name="nom_paroisse">
                </div>
                <div class="col-md-6">
                    <p>Adresse de la paroisse:</p>
                    <input type="text" placeholder="Adresse" name="adresse_paroisse">
                    
                </div>
            </div>

           
            <div class="row">
                <p>Pays:</p>
                <select name="pays_id" class="form-control" onchange="loadCities(this.value); phoneCode(this.value)" required>
                    <!-- Options de pays -->
                    <option value="" disabled selected>Sélectionnez un pays</option>
                    @foreach($pays as $itemPays)
                        <option value="{{ $itemPays->id }}">{{ $itemPays->libelle}}</option>
                    @endforeach
                </select>

                
                <div class="col-md-6">
                    <p class="hidden" id="villeLabel">Ville:</p>
                    <select style="border-color:aqua" name="ville_id" class="form-control hidden" id="villeSelect" onchange="loadCommunes(this.value)" required>
                        <option value="" disabled selected>Sélectionnez la ville</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <p class="hidden" id="communeLabel">Commune:</p>
                    <select style="border-color:rgb(0, 110, 255)" name="commune_id" class="form-control hidden" id="communeSelect" onchange="loadNeighborhoods(this.value)" required>
                        <option value="" disabled selected>Sélectionnez la commune</option>
                    </select>
                </div>
               
                <div class="col-md-6">
                    <p class="hidden" id="quartierLabel">Quartier:</p>
                    <select style="border-color:rgb(0, 255, 76)" name="quartier_id" class="form-control hidden" id="quartierSelect" required>
                        <option value="" disabled selected>Sélectionnez le quartier</option>
                    </select>
                </div>
            </div>
           
            <div class="index-btn-wrapper">
                <div class="index-btn" onclick="run(1, 2);">Suivant</div>
            </div>
        </div>
    
        <div class="tab" id="tab-2">
            <div class="row">
                <div class="col-md-6">
                    <p>Nom et prénom du chargé:</p>
                    <input type="text" placeholder="Nom et prénom du chargé" name="nom_charge">
                </div>
                <div class="col-md-6">
                    <p>Numéro du chargé:</p>
                    <div class="phone-number-container">
                        <input type="text" name="phone_code" value="" id="phone_code_1" placeholder="+xxx" disabled>
                        <input type="number" placeholder="xxxxxxxx" name="numero_charge">
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <p>Nom et prénom du sécrétaire:</p>
                    <input type="text" placeholder="Nom et prénom du sécrétaire" name="nom_secretaire">
                </div>
                <div class="col-md-6">
                    <p>Numéro du sécrétaire:</p>
                    <div class="phone-number-container">
                        <input type="text" name="phone_code" value="" id="phone_code_2" placeholder="+xxx" disabled>
                        <input type="number" placeholder="xxxxxxxx" name="numero_secretaire">
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <p>Nom et prénom du maître de choeur:</p>
                    <input type="text" placeholder="Nom et prénom du maître de choeur" name="nom_maitre_choeur">
                </div>
                <div class="col-md-6">
                    <p>Numéro du maître de choeur:</p>
                    <div class="phone-number-container">
                        <input type="text" name="phone_code" value="" id="phone_code_3" placeholder="+xxx" disabled>
                        <input type="number" placeholder="xxxxxxxx" name="numero_maitre_choeur">
                    </div>
                </div>
            </div>
           
            
            <div class="index-btn-wrapper">
                <div class="index-btn" onclick="run(2, 1);">Précédent</div>
                <div class="index-btn" onclick="run(2, 3);">Suivant</div>
            </div>
        </div>
        
    
        <div class="tab" id="tab-3">
            <p>Photo de l'église:</p>
            <input type="file" name="image_eglise" accept="image/jpeg, image/png, image/gif" onchange="uploadFiles(this)">
            <div class="progress" role="progressbar" aria-label="Progression du téléchargement" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar bg-success" style="width: 0%" id="fileProgress">0%</div>
            </div>
            <div class="index-btn-wrapper">
                <div class="index-btn" onclick="run(3, 2);">Previous</div>
                <div class="index-btn" onclick="run(3, 4);">Next</div>
    
            </div>
        </div>
    
        <div class="tab" id="tab-4">
    
            <div class="row">
                <div class="col-md-12">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                          <h5 class="card-title">Vérification</h5>
                          <p class="card-text">Veuillez vérifier avant de cliquer sur le bouton soumettre</p>
                        </div>
                    </div>
                </div>
            </div>
            
          
            <div class="index-btn-wrapper">
                <div class="index-btn" onclick="run(4, 3);">Précédent</div>
                <button class="index-btn" type="submit" name="submit" style="background: rgb(102, 102, 233);">Soumettre</button>
            </div>
        </div>
    
        {{-- <div class="tab" id="tab-4">
            <p>Localisation de la paroisse:</p>
            <div id="map"></div>
            <input type="hidden" id="latitude" name="latitude">
            <input type="hidden" id="longitude" name="longitude">
            <div class="index-btn-wrapper">
                <div class="index-btn" onclick="run(4, 3);">Précédent</div>
                <button class="index-btn" type="submit" name="submit" style="background: blue;">Soumettre</button>
            </div>
        </div> --}}
    </form>
  </div>
  


  
@endsection


@section('script')

<script>
    // Default tab
    $(".tab").css("display", "none");
    $("#tab-1").css("display", "block");

    function run(hideTab, showTab) {
        if (hideTab < showTab) { // Si ce n'est pas le bouton Précédent qui est cliqué
            var currentTab = $('#tab-' + hideTab);
            var inputs = currentTab.find("input, select");

            for (var i = 0; i < inputs.length; i++) {
                var input = inputs[i];

               // Vérifier si le champ est un numéro et s'il contient uniquement des chiffres
                if (input.type === 'text' && input.name.startsWith('numero_')) {
                    if (isNaN(input.value.replace(/\s/g, ''))) {
                        $(input).css("background", "#ffdddd");
                        alert("Veuillez saisir uniquement des chiffres dans le champ de numéro.");
                        return;
                    }

                    // Vérifier le préfixe "+"
                    if (!input.value.startsWith('+')) {
                        $(input).css("background", "#ffdddd");
                        alert("Veuillez saisir un numéro valide au format +xxx xxxxxxxx.");
                        return;
                    }
                }

                // Vérifier les autres champs pour s'assurer qu'ils sont remplis
                if (!input.value) {
                    $(input).css("background", "#ffdddd");
                    alert("Veuillez remplir tous les champs avant de passer à l'étape suivante.");
                    return;
                }
            }
        }

        // Progression de la barre
        for (var j = 1; j < showTab; j++) {
            $("#step-" + j).css("opacity", "1");
        }

        // Passage à l'étape suivante
        $("#tab-" + hideTab).css("display", "none");
        $("#tab-" + showTab).css("display", "block");
        $("input").css("background", "#fff");
    }

  </script>


<script>
    function uploadFiles(input) {
        var progressBar = document.getElementById('fileProgress');
        var files = input.files;
  
        if (files.length > 0) {
            var totalSize = 0;
  
            for (var i = 0; i < files.length; i++) {
                totalSize += files[i].size;
            }
  
            var loaded = 0;
            var xhr = new XMLHttpRequest();
  
            xhr.upload.addEventListener('progress', function(event) {
                if (event.lengthComputable) {
                    loaded = event.loaded; // Utiliser event.loaded pour obtenir la taille chargée
                    var percentComplete = (loaded / totalSize) * 100;
  
                    // Limiter la barre de progression à 100%
                    if (percentComplete > 100) {
                        percentComplete = 100;
                    }
  
                    progressBar.style.width = percentComplete + '%';
                    progressBar.innerText = Math.round(percentComplete) + '%';
  
                    // Activer le bouton de soumission lorsque le téléchargement est complet
                    if (percentComplete === 100) {
                        document.querySelector('button[name="submit"]').removeAttribute('disabled');
                    }
                }
            });
  
            xhr.open('POST', '/enregistrer-paroisse', true);
            xhr.send(new FormData(document.getElementById('paroisseForm')));
        } else {
            alert('Veuillez sélectionner au moins un fichier.');
        }
    }
  </script>
  



<script>
   function loadCities(paysId) {
        if (paysId) {
            // Masquer les selects de la commune et du quartier
            document.getElementById('communeLabel').classList.add('hidden');
            document.getElementById('communeSelect').classList.add('hidden');
            document.getElementById('quartierLabel').classList.add('hidden');
            document.getElementById('quartierSelect').classList.add('hidden');

            // Charger les villes via une requête AJAX
            $.ajax({
                type: "GET",
                url: "{{ route('load.cities') }}",
                data: { pays_id: paysId },
                success: function(response) {
                    // Mettre à jour les options du select de la ville avec l'option "Sélectionner la ville" en première position
                    var select = document.getElementById('villeSelect');
                    select.innerHTML = "<option value='' disabled selected>Sélectionner la ville</option>";
                    response.forEach(function(ville) {
                        var option = document.createElement('option');
                        option.value = ville.id;
                        option.text = ville.libelle; // Assurez-vous d'avoir un champ 'libelle' dans votre modèle Ville
                        select.appendChild(option);
                    });

                    // Rendre visible le select de la ville
                    document.getElementById('villeLabel').classList.remove('hidden');
                    document.getElementById('villeSelect').classList.remove('hidden');
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    // Gérer les erreurs si nécessaire
                }
            });
        }
    }


    function loadCommunes(villeId) {
        if (villeId) {
            // Masquer le select du quartier
            document.getElementById('quartierLabel').classList.add('hidden');
            document.getElementById('quartierSelect').classList.add('hidden');

            // Charger les communes via une requête AJAX
            $.ajax({
                type: "GET",
                url: "{{ route('load.communes') }}",
                data: { ville_id: villeId },
                success: function(response) {
                    // Mettre à jour les options du select de la commune avec l'option "Sélectionner la commune" en première position
                    var select = document.getElementById('communeSelect');
                    select.innerHTML = "<option value='' disabled selected>Sélectionner la commune</option>";
                    response.forEach(function(commune) {
                        var option = document.createElement('option');
                        option.value = commune.id;
                        option.text = commune.libelle; // Assurez-vous d'avoir un champ 'libelle' dans votre modèle Commune
                        select.appendChild(option);
                    });

                    // Rendre visible le select de la commune
                    document.getElementById('communeLabel').classList.remove('hidden');
                    document.getElementById('communeSelect').classList.remove('hidden');
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    // Gérer les erreurs si nécessaire
                }
            });
        }
    }

    function loadNeighborhoods(communeId) {
        if (communeId) {
            // Charger les quartiers via une requête AJAX
            $.ajax({
                type: "GET",
                url: "{{ route('load.quartiers') }}",
                data: { commune_id: communeId },
                success: function(response) {
                    // Mettre à jour les options du select du quartier avec l'option "Sélectionner le quartier" en première position
                    var select = document.getElementById('quartierSelect');
                    select.innerHTML = "<option value='' disabled selected>Sélectionner le quartier</option>";
                    response.forEach(function(quartier) {
                        var option = document.createElement('option');
                        option.value = quartier.id;
                        option.text = quartier.libelle; // Assurez-vous d'avoir un champ 'libelle' dans votre modèle Quartier
                        select.appendChild(option);
                    });

                    // Rendre visible le select du quartier
                    document.getElementById('quartierLabel').classList.remove('hidden');
                    document.getElementById('quartierSelect').classList.remove('hidden');
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    // Gérer les erreurs si nécessaire
                }
            });
        }
    }


    function phoneCode(paysId){
        if (paysId) {
              // Charger les villes via une requête AJAX
              $.ajax({
                type: "GET",
                url: "{{ route('load.phoneCode') }}",
                data: { pays_id: paysId },
                success: function(response) {
                    // Supposons que la réponse contienne un champ 'phone_code'
                    var phoneCode = response.phone_code; 
                    console.log(phoneCode);
                        // Mettre à jour tous les champs phone_code avec la valeur reçue
                    $('input[name="phone_code"]').val(phoneCode);               
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    // Gérer les erreurs si nécessaire
                }
            });
        }
    }



</script>


@endsection