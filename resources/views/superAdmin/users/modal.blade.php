 {{-- modal --}}
 <div class="modal fade" id="modal-primary">
    <div class="modal-dialog">
    <div class="modal-content bg-primary">
        <form class="form-horizontal" method="POST" action="{{ route("superAdmin.users.store")}}">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">@lang('quickadmin.qa_create')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            
                    <div class="card-body">
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">{{trans('quickadmin.users.fields.name').'*'}}</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="" required>
                        </div>
                        <p class="help-block"></p>
                        @if($errors->has('name'))
                            <p class="help-block">{{ $errors->first('name') }}</p>
                        @endif
                    </div>
                    

                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">{{trans('quickadmin.users.fields.email').'*'}}</label>
                        <div class="col-sm-10">
                            <input type="text" name="email" value="{{ old('email') }}" class="form-control" placeholder="" required>
                        </div>
                        <p class="help-block"></p>
                        @if($errors->has('email'))
                            <p class="help-block">{{ $errors->first('email') }}</p>
                        @endif
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">{{trans('quickadmin.users.fields.password').'*'}}</label>
                        <div class="col-sm-10">
                            <input type="text" name="password" value="{{ old('password') }}" class="form-control" placeholder="" required>
                        </div>
                        <p class="help-block"></p>
                        @if($errors->has('password'))
                            <p class="help-block">{{ $errors->first('password') }}</p>
                        @endif
                    </div>

                    <div class="form-group row">
                        <label for="role_id" class="col-sm-2 col-form-label">{{trans('quickadmin.users.fields.role').'*'}}</label>
                        <div class="col-sm-10">
                            <select name="role_id" id="role_id" class="form-control select2" required>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{   old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <p class="help-block"></p>
                        @if($errors->has('role_id'))
                            <p class="help-block">{{ $errors->first('role_id') }}</p>
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