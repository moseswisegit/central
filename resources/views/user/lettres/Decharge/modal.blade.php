 {{-- modal --}}
 <div class="modal fade" id="decharge-primary">
    <div class="modal-dialog">
    <div class="modal-content bg-info">
        <form class="form-horizontal" method="POST" action="{{ route("user.genererLettre")}}">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">@lang('quickuser.qa_create')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="nom_receveur" class="col-sm-4 col-form-label">{{trans('quickuser.decharge.fields.nom_receveur').'*'}}</label>
                        <div class="col-sm-8">
                            <input type="text" name="nom_receveur" value="{{ old('nom_receveur') }}" class="form-control" placeholder="" required>
                        </div>
                        <p class="help-block"></p>
                        @if($errors->has('nom_receveur'))
                            <p class="help-block">{{ $errors->first('nom_receveur') }}</p>
                        @endif
                    </div>


                    <div class="form-group row">
                        <label for="date_emission" class="col-sm-4 col-form-label">{{trans('quickuser.decharge.fields.date').'*'}}</label>
                        <div class="col-sm-8">
                            <input type="date" name="date_emission" value="{{ old('date_emission') }}" class="form-control" placeholder="" >
                        </div>
                        <p class="help-block"></p>
                        @if($errors->has('date_emission'))
                            <p class="help-block">{{ $errors->first('date_emission') }}</p>
                        @endif
                    </div>

                    <div class="form-group row">
                        <label for="nom_donneur" class="col-sm-4 col-form-label">{{trans('quickuser.decharge.fields.nom_donneur').'*'}}</label>
                        <div class="col-sm-8">
                            <input type="text" name="nom_donneur" value="{{ old('nom_donneur') }}" class="form-control" placeholder="" required>
                        </div>
                        <p class="help-block"></p>
                        @if($errors->has('nom_donneur'))
                            <p class="help-block">{{ $errors->first('nom_donneur') }}</p>
                        @endif
                    </div>

                    <div class="form-group row">
                        <label for="montant" class="col-sm-4 col-form-label">{{trans('quickuser.decharge.fields.montant').'*'}}</label>
                        <div class="col-sm-8">
                            <input type="number" name="montant" value="{{ old('montant') }}" class="form-control" placeholder="" >
                        </div>
                        <p class="help-block"></p>
                        @if($errors->has('montant'))
                            <p class="help-block">{{ $errors->first('montant') }}</p>
                        @endif
                    </div>

                    <div class="form-group row">
                        <label for="motif" class="col-sm-4 col-form-label">{{trans('quickuser.decharge.fields.motif').'*'}}</label>
                        <div class="col-sm-8">
                            <textarea name="motif" id="" cols="35" rows="5"></textarea>
                        </div>
                        <p class="help-block"></p>
                        @if($errors->has('motif'))
                            <p class="help-block">{{ $errors->first('motif') }}</p>
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