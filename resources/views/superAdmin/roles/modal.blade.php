 {{-- modal --}}
 <div class="modal fade" id="modal-primary">
    <div class="modal-dialog">
    <div class="modal-content bg-primary">
        <form class="form-horizontal" method="POST" action="{{ route("superAdmin.roles.store")}}">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">@lang('quickadmin.qa_create')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            
                    <div class="card-body">
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">{{trans('quickadmin.roles.fields.title').'*'}}</label>
                        <div class="col-sm-10">
                            <input type="text" name="title" value="{{ old('title') }}" class="form-control" placeholder="" required>
                        </div>
                        <p class="help-block"></p>
                        @if($errors->has('title'))
                            <p class="help-block">{{ $errors->first('title') }}</p>
                        @endif
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