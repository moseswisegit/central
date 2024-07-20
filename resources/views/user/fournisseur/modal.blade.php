 {{-- modal --}}
 <div class="modal fade" id="fournisseur-primary">
    <div class="modal-dialog">
    <div class="modal-content bg-primary">
        <form class="form-horizontal" method="POST" action="{{ route("user.fournisseur.store")}}">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">@lang('quickuser.qa_create')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
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
            
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Fermer</button>
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