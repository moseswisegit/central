 {{-- modal --}}
 <div class="modal fade" id="ville-primary">
    <div class="modal-dialog">
    <div class="modal-content bg-primary">
        <form class="form-horizontal" method="POST" action="{{ route("superAdmin.ville.store")}}">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">@lang('quickadmin.qa_create')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            
                    <div class="card-body">
                    <div class="form-group row">
                        <label for="libelle" class="col-sm-2 col-form-label">{{trans('quickadmin.ville.fields.libelle').'*'}}</label>
                        <div class="col-sm-10">
                            <input type="text" name="libelle" value="{{ old('libelle') }}" class="form-control" placeholder="" required>
                        </div>
                        <p class="help-block"></p>
                        @if($errors->has('libelle'))
                            <p class="help-block">{{ $errors->first('libelle') }}</p>
                        @endif
                    </div>
                    <div class="form-group row">
                        <label for="libelle" class="col-sm-2 col-form-label">{{trans('quickadmin.pays.fields.libelle').'*'}}</label>
                        <select name="pays_id" class="form-control col-sm-10" required>
                            <option value="" disabled selected>Sélectionnez un pays</option>
                            @foreach($pays as $item)
                                <option value="{{ $item->id }}">{{ $item->libelle }}</option>
                            @endforeach
                        </select>
                    </div>

                    
                
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn btn-danger">{{ trans('quickadmin.qa_save')}}</button>
            </div>
        </form>
    </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->