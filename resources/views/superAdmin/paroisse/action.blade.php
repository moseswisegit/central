{{-- edit modal --}}

<div class="modal fade" id="paroisse-info{{ $paroisse->id }}">
    <div class="modal-dialog">
        <form method="POST" action="{{ route("superAdmin.paroisse.update",$paroisse->id)}}">
            @csrf
            @method("PUT")
            <div class="modal-content bg-info">
                <div class="modal-header">
                <h4 class="modal-title">@lang('quickadmin.qa_edit')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                
                    <div class="form-group row">
                        <label for="libelle" class="col-sm-2 col-form-label">{{trans('quickadmin.paroisse.fields.libelle').'*'}}</label>
                        <div class="col-sm-10">
                            <input type="text"  name="libelle" value="{{$paroisse->libelle }}" class="form-control" placeholder="" required>
                        </div>
                        <p class="help-block"></p>
                        @if($errors->has('libelle'))
                            <p class="help-block">{{ $errors->first('libelle') }}</p>
                        @endif
                    </div>
                    
                </div>
                <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">{{ trans('quickadmin.qa_update')}}</button>
                </div>
            </div>
        </form>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->



{{-- delete modal --}}

<div class="modal fade" id="paroisse-danger{{$paroisse->id }}">
    <div class="modal-dialog">
      <div class="modal-content bg-danger">
        <div class="modal-header">
          <h4 class="modal-title">Danger Modal</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form  action="{{ route('superAdmin.paroisse.destroy',$paroisse->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-body">
                <h4> Voulez-vous vraiment supprimer cette ligne</h4>
            
                
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
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

<div class="modal fade" id="paroisse-default{{$paroisse->id }}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"> Indormation sur  {{$paroisse->title }}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         
            {{-- <div class="info-box">
                <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>
  
                <div class="info-box-content">
                  <span class="info-box-text">Bookmarks</span>
                  <span class="info-box-number">410</span>
                </div>
                <!-- /.info-box-content -->
              </div> --}}

              
                <div class="position-relative p-3 bg-white" style="height: 180px">
                  <div class="ribbon-wrapper ribbon-lg">
                    <div class="ribbon bg-yellow">
                        {{$paroisse->title }}
                    </div>
                  </div>

                  <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>
      
                    <div class="info-box-content">
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">{{trans('quickadmin.admins.fields.name')}}</label>
                            <div class="col-sm-8">
                                <input type="text"  name="name" value="{{$paroisse->title }}" class="form-control" placeholder="" disabled>
                            </div>
                        </div>
                       
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                
                </div>
              

        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->


  <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de vouloir modifier la décision ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" id="confirmButton">Confirmer</button>
            </div>
        </div>
    </div>
</div>

