{{-- edit modal --}}

<div class="modal fade" id="quartier-info{{ $item->id }}">
    <div class="modal-dialog">
        <form method="POST" action="{{ route("superAdmin.quartier.update",$item->id)}}">
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
                        <label for="libelle" class="col-sm-2 col-form-label">{{trans('quickadmin.quartier.fields.libelle').'*'}}</label>
                        <div class="col-sm-10">
                            <input type="text"  name="libelle" value="{{$item->libelle }}" class="form-control" placeholder="" required>
                        </div>
                        <p class="help-block"></p>
                        @if($errors->has('libelle'))
                            <p class="help-block">{{ $errors->first('libelle') }}</p>
                        @endif
                    </div>

                    <div class="form-group row">
                      <label for="libelle" class="col-sm-2 col-form-label">{{trans('quickadmin.commune.fields.libelle').'*'}}</label>
                      <select name="commune_id" class="form-control col-sm-10" required>
                          <option value="" disabled selected>Sélectionnez la commune</option>
                          @foreach($commune as $itemCommune)
                            <option value="{{ $itemCommune->id }}" {{ $item->commune_id == $itemCommune->id ? 'selected' : '' }}>
                                {{ $itemCommune->libelle }}
                            </option>
                          @endforeach
                      </select>
                  </div>
                    
                </div>
                <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
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

<div class="modal fade" id="quartier-danger{{$item->id }}">
    <div class="modal-dialog">
      <div class="modal-content bg-danger">
        <div class="modal-header">
          <h4 class="modal-title">Danger Modal</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form  action="{{ route('superAdmin.quartier.destroy',$item->id) }}" method="POST">
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

<div class="modal fade" id="quartier-default{{$item->id }}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"> Indormation sur  {{$item->title }}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
                <div class="position-relative p-3 bg-white" style="height: 180px">
                  <div class="ribbon-wrapper ribbon-lg">
                    <div class="ribbon bg-yellow">
                        {{$item->libelle }}
                    </div>
                  </div>

                  <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>
      
                    <div class="info-box-content">
                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label">{{trans('quickadmin.quartier.fields.libelle')}}</label>
                            <div class="col-sm-8">
                                <input type="text"  name="name" value="{{$item->libelle }}" class="form-control" placeholder="" disabled>
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

