{{-- edit modal --}}

<div class="modal fade" id="produits-info{{ $produit->id }}">
    <div class="modal-dialog modal-lg">
        <form method="POST" action="{{ route("user.produits.update",$produit->id)}}">
            @csrf
            @method("PUT")
            <div class="modal-content bg-info">
                <div class="modal-header">
                <h4 class="modal-title">@lang('quickuser.qa_edit')</h4>
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
                              <input type="text" name="designation" value="{{$produit->designation}}" class="form-control" placeholder="" required>
                              <p class="help-block"></p>
                              @if($errors->has('designation'))
                                  <p class="help-block">{{ $errors->first('designation') }}</p>
                              @endif
                            </div>
                          </div>
                    
                          <div class="col-sm-4">
                            <!-- text input -->
                            <div class="form-group">
                              <label  for="qte_command">{{trans('quickuser.produits.fields.qte_command').'*'}}</label>
                              <input type="number" id="qte_command" name="qte_command" value="{{$produit->qte_command}}" class="form-control" placeholder="" oninput="verifierQuantite()" required>
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
                              <input type="number" id="qte_recu" name="qte_recu" value="{{$produit->qte_recu}}" class="form-control" placeholder="" oninput="verifierQuantite(); calculateMontant();" required>
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
                              <input type="number" id="prix_unitaire" name="prix_unitaire" value="{{$produit->prix_unitaire}}" class="form-control" placeholder=""  oninput="calculateMontant()" required>
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
                              <input type="number" id="montant" name="montant" value="{{$produit->montant}}" class="form-control" placeholder="" disabled>
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
                              <input type="date" name="date_livraison" value="{{$produit->date_livraison}}" class="form-control" placeholder="" required>
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
    
                              <select class="form-control" name="categorie_id">
                                @foreach($categories as $categorie)
                                    <option value="{{ $categorie->id }}" {{ $produit->categorie_id == $categorie->id ? 'selected' : '' }}>
                                        {{ $categorie->libelle }}
                                    </option>
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
                             
                              <select class="form-control" name="fournisseur_id">
                                @foreach($fournisseurs as $fournisseur)
                                    <option value="{{ $fournisseur->id }}" {{ $produit->fournisseur_id == $fournisseur->id ? 'selected' : '' }}>
                                        {{ $fournisseur->libelle }}
                                    </option>
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
                              <select class="form-control" name="etat_livraison" id="etat_livraison">
                                <option value="oui" @if(old('etat_livraison', $produit->etat_livraison) == 'oui') selected @endif>Livré</option>
                                <option value="non" @if(old('etat_livraison', $produit->etat_livraison) == 'non') selected @endif>Non Livré</option>
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
                  <button type="button" class="btn btn-outline-light" data-dismiss="modal">Fermer</button>
                  <button type="submit" class="btn btn-success">{{ trans('quickuser.qa_update')}}</button>
                </div>
            </div>
        </form>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->



{{-- delete modal --}}

<div class="modal fade" id="produits-danger{{$produit->id }}">
    <div class="modal-dialog">
      <div class="modal-content bg-danger">
        <div class="modal-header">
          <h4 class="modal-title">Suppression</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form  action="{{ route('user.produits.destroy',$produit->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-body">
                <h4> Voulez-vous vraiment supprimer cette ligne</h4>

            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Fermer</button>
            <button type="submit" class="btn btn-outline-light">Supprimer</button>
            </div>
    </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
<!-- /.modal -->

<div class="modal fade" id="produits-default{{$produit->id }}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"> Indormation sur  {{$produit->designation }}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
                <div class="position-relative bg-white">
                  <div class="ribbon-wrapper ribbon-lg">
                    <div class="ribbon bg-yellow">
                        {{$produit->designation }}
                    </div>
                  </div>

                  <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>
                    <div class="info-box-content">
                        <div class="form-group row">
                            <label for="designation" class="col-sm-4 col-form-label">{{trans('quickuser.produits.fields.libelle')}}</label>
                            <div class="col-sm-8">
                                <input type="text"  name="designation" value="{{$produit->designation }}" class="form-control" placeholder="" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                          <label for="qte_command" class="col-sm-4 col-form-label">{{trans('quickuser.produits.fields.qte_command')}}</label>
                          <div class="col-sm-8">
                              <input type="text"  name="qte_command" value="{{$produit->qte_command }}" class="form-control" placeholder="" disabled>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="qte_recu" class="col-sm-4 col-form-label">{{trans('quickuser.produits.fields.qte_recu')}}</label>
                          <div class="col-sm-8">
                              <input type="text"  name="qte_recu" value="{{$produit->qte_recu }}" class="form-control" placeholder="" disabled>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="prix_unitaire" class="col-sm-4 col-form-label">{{trans('quickuser.produits.fields.prix_unitaire')}}</label>
                          <div class="col-sm-8">
                              <input type="text"  name="prix_unitaire" value="{{$produit->prix_unitaire }}" class="form-control" placeholder="" disabled>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="montant" class="col-sm-4 col-form-label">{{trans('quickuser.produits.fields.montant')}}</label>
                          <div class="col-sm-8">
                              <input type="text"  name="montant" value="{{$produit->montant }}" class="form-control" placeholder="" disabled>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="categorie_id" class="col-sm-4 col-form-label">{{trans('quickuser.produits.fields.categorie_id')}}</label>
                          <div class="col-sm-8">
                              <input type="text"  name="categorie_id" value="{{$produit->categorie->libelle }}" class="form-control" placeholder="" disabled>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="fournisseur_id" class="col-sm-4 col-form-label">{{trans('quickuser.produits.fields.fournisseur_id')}}</label>
                          <div class="col-sm-8">
                              <input type="text"  name="fournisseur_id" value="{{$produit->fournisseur->libelle }}" class="form-control" placeholder="" disabled>
                          </div>
                        </div>
                       
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                
                </div>
        </div>
        <div class="modal-footer justify-content-between  offset-md-9">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
          {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

