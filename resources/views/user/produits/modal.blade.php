 {{-- modal --}}
 <div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <form class="form-horizontal" method="POST" action="{{ route("user.produits.store")}}">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">@lang('quickuser.qa_create')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            
            <div class="card-body">     
                <div role="form">
                    <div class="row">
                      <div class="col-sm-4">
                        <!-- text input -->
                        <div class="form-group">
                          <label  for="designation">{{trans('quickuser.produits.fields.libelle').'*'}}</label>
                          <input type="text" name="designation" value="{{ old('designation') }}" class="form-control" placeholder="" required>
                          <p class="help-block"></p>
                          @if($errors->has('designation'))
                              <p class="help-block">{{ $errors->first('libelle') }}</p>
                          @endif
                        </div>
                      </div>
                
                      <div class="col-sm-4">
                        <!-- text input -->
                        <div class="form-group">
                          <label  for="qte_command">{{trans('quickuser.produits.fields.qte_command').'*'}}</label>
                          <input type="number" id="qte_command" name="qte_command" value="{{ old('qte_command') }}" class="form-control" placeholder="" oninput="verifierQuantite()" required>
                          <p class="help-block"></p>
                          @if($errors->has('qte_command'))
                              <p class="help-block">{{ $errors->first('qte_command') }}</p>
                          @endif
                        </div>
                      </div>
                
                      <div class="col-sm-4">
                        <!-- text input -->
                        <div class="form-group">
                          <label  for="qte_recu">{{trans('quickuser.produits.fields.qte_recu').'*'}}</label>
                          <input type="number" id="qte_recu" name="qte_recu" value="0" class="form-control" placeholder="" oninput="verifierQuantite(); calculateMontant();" required>
                          <p class="help-block"></p>
                          @if($errors->has('qte_recu'))
                              <p class="help-block">{{ $errors->first('qte_recu') }}</p>
                          @endif
                        </div>
                      </div>
                
                      <div class="col-sm-4">
                        <!-- text input -->
                        <div class="form-group">
                          <label  for="prix_unitaire">{{trans('quickuser.produits.fields.prix_unitaire').'*'}}</label>
                          <input type="number" id="prix_unitaire" name="prix_unitaire" value="0" class="form-control" placeholder=""  oninput="calculateMontant()" required>
                          <p class="help-block"></p>
                          @if($errors->has('prix_unitaire'))
                              <p class="help-block">{{ $errors->first('prix_unitaire') }}</p>
                          @endif
                        </div>
                      </div>
                
                      <div class="col-sm-4">
                        <!-- text input -->
                        <div class="form-group">
                          <label  for="montant">{{trans('quickuser.produits.fields.montant').'*'}}</label>
                          <input type="number" id="montant" name="prix_unitaire" value="0" class="form-control" placeholder="" disabled>
                          <p class="help-block"></p>
                          @if($errors->has('montant'))
                              <p class="help-block">{{ $errors->first('montant') }}</p>
                          @endif
                        </div>
                      </div>

                      <div class="col-sm-4">
                        <!-- text input -->
                        <div class="form-group">
                          <label  for="date_livraison">{{trans('quickuser.produits.fields.date_livraison').'*'}}</label>
                          <input type="date" name="date_livraison" value="{{ old('date_livraison') }}" class="form-control" placeholder="" required>
                          <p class="help-block"></p>
                          @if($errors->has('date_livraison'))
                              <p class="help-block">{{ $errors->first('date_livraison') }}</p>
                          @endif
                        </div>
                    </div>
                 
                    </div>
                    
                    <div class="row">
                      <div class="col-sm-4">
                        <!-- select -->
                        <div class="form-group">
                          <label for="categorie_id">{{trans('quickuser.produits.fields.categorie_id')}}</label>
                           <button type="button" class="btn btn-default" data-toggle="modal" data-target="#categorie-sm">
                            <i class="nav-icon fas fa-plus text-success"></i>
                          </button>

                          <select class="form-control select2bs4" name="categorie_id">
                            @foreach($categories as $categorie)
                                <option value="{{ $categorie->id }}">{{ $categorie->libelle }}</option>
                            @endforeach
                          </select>
                          <p class="help-block"></p>
                            @if($errors->has('categorie_id'))
                                <p class="help-block">{{ $errors->first('categorie_id') }}</p>
                            @endif

                            
                        </div>
                      </div>
                
                      <div class="col-sm-4">
                        <!-- select -->
                        <div class="form-group">
                          <label for="fournisseur_id">{{trans('quickuser.produits.fields.fournisseur_id').'*'}}</label>
                          <button type="button" class="btn btn-default" data-toggle="modal" data-target="#fournisseur-sm">
                            <i class="nav-icon fas fa-plus text-success"></i>
                          </button>
                          
                          <select class="form-control select2bs4" name="fournisseur_id">
                            @foreach($fournisseurs as $fournisseur)
                            <option value="{{ $fournisseur->id }}">{{ $fournisseur->libelle }}</option>
                            @endforeach
                          </select>
                          <p class="help-block"></p>
                            @if($errors->has('fournisseur_id'))
                                <p class="help-block">{{ $errors->first('fournisseur_id') }}</p>
                            @endif
                        </div>
                       
                      </div>

                      <div class="col-sm-4">
                        <!-- select -->
                        <div class="form-group">
                          <label for="etat_livraison">{{trans('quickuser.produits.fields.etat_livraison').'*'}}</label>
                          <select class="form-control" name="etat_livraison">
                            <option value="oui">Livré</option>
                            <option value="non">Non Livré</option>
                          </select>
                          <p class="help-block"></p>
                            @if($errors->has('etat_livraison'))
                                <p class="help-block">{{ $errors->first('etat_livraison') }}</p>
                            @endif
                        </div>
                      </div>
                    </div>
                    </div>
                
                   
                
                
                   
                </div>                  
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn btn-danger">{{ trans('quickuser.qa_save')}}</button>
            </div>
        </div>
        
        </form>
    </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->



<div class="modal fade" id="categorie-sm">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Ajouté catégorie</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="categorieForm" class="form-horizontal" method="POST" action="{{ route("user.categorie.store")}}">
        @csrf

        <div class="modal-body">
          <div class="form-group row">
              <label for="libelle" class="col-sm-2 col-form-label">{{trans('quickuser.categorie.fields.libelle').'*'}}</label>
              <div class="col-sm-10">
                  <input type="text" id="libelle" name="libelle" value="{{ old('libelle') }}" class="form-control" placeholder="" required>
              </div>
              <p class="help-block"></p>
              @if($errors->has('libelle'))
                  <p class="help-block">{{ $errors->first('libelle') }}</p>
              @endif
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
          <button type="button" class="btn btn-primary" onclick="enregistrerCategorie()">Enrégistrer</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


<div class="modal fade" id="fournisseur-sm">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Ajouté fournisseur</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form  id="fournisseurForm" class="form-horizontal" method="POST" action="{{ route("user.fournisseur.store")}}">
                @csrf
                <div class="form-group row">
                  <label for="libelle" class="col-sm-2 col-form-label">{{trans('quickuser.fournisseur.fields.libelle').'*'}}</label>
                  <div class="col-sm-10">
                      <input type="text" name="libelle" value="{{ old('libelle') }}" class="form-control" placeholder="" required>
                  </div>
                  <p class="help-block"></p>
                  @if($errors->has('libelle'))
                      <p class="help-block">{{ $errors->first('libelle') }}</p>
                  @endif
                </div>

                <div class="form-group row">
                    <label for="adresse" class="col-sm-2 col-form-label">{{trans('quickuser.fournisseur.fields.adresse').'*'}}</label>
                    <div class="col-sm-10">
                        <input type="text" name="adresse" value="{{ old('adresse') }}" class="form-control" placeholder="" >
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('adresse'))
                        <p class="help-block">{{ $errors->first('adresse') }}</p>
                    @endif
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                  <button type="button" class="btn btn-primary" onclick="enregistrerFournisseur()">Enrégistrer</button>
                </div>
        </form>
      </div>
  </div>
    <!-- /.modal-content -->
  <!-- /.modal-dialog -->
</div>





