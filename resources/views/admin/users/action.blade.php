{{-- edit modal --}}

<div class="modal fade" id="modal-info{{ $user->id }}">
    <div class="modal-dialog">
        <form method="POST" action="{{ route("superAdmin.users.update",$user->id)}}">
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
                        <label for="name" class="col-sm-2 col-form-label">{{trans('quickadmin.users.fields.name').'*'}}</label>
                        <div class="col-sm-10">
                            <input type="text"  name="name" value="{{ $user->name }}" class="form-control" placeholder="" required>
                        </div>
                        <p class="help-block"></p>
                        @if($errors->has('name'))
                            <p class="help-block">{{ $errors->first('name') }}</p>
                        @endif
                    </div>
                    

                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">{{trans('quickadmin.users.fields.email').'*'}}</label>
                        <div class="col-sm-10">
                            <input type="text"  name="email" value="{{ $user->email }}" class="form-control" placeholder="" required>
                        </div>
                        <p class="help-block"></p>
                        @if($errors->has('email'))
                            <p class="help-block">{{ $errors->first('email') }}</p>
                        @endif
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">{{trans('quickadmin.users.fields.password').'*'}}</label>
                        <div class="col-sm-10">
                            <input type="text"   name="password" value="{{ $user->password }}" class="form-control" placeholder="">
                        </div>
                        <p class="help-block"></p>
                        @if($errors->has('password'))
                            <p class="help-block">{{ $errors->first('password') }}</p>
                        @endif
                    </div>

                    <div class="form-group row">
                        <label for="role_id" class="col-sm-2 col-form-label">{{trans('quickadmin.users.fields.role').'*'}}</label>
                        <div class="col-sm-10">
                            <select name="role_id" class="form-control select2" required>
                                @foreach($roles as $key => $value)
                                    <option value="{{ $key }}" {{  $user->role_id  == $key ? 'selected' : '' }}>{{ $value }}</option>
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

<div class="modal fade" id="modal-danger{{ $user->id }}">
    <div class="modal-dialog">
      <div class="modal-content bg-danger">
        <div class="modal-header">
          <h4 class="modal-title">Danger Modal</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form  action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
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

<div class="modal fade" id="modal-default{{ $user->id }}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"> Indormation sur  {{ $user->name }}</h4>
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
                        {{ $user->name }}
                    </div>
                  </div>

                  <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>
      
                    <div class="info-box-content">
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">{{trans('quickadmin.users.fields.name')}}</label>
                            <div class="col-sm-8">
                                <input type="text"  name="name" value="{{ $user->name }}" class="form-control" placeholder="" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">{{trans('quickadmin.users.fields.email')}}</label>
                            <div class="col-sm-8">
                                <input type="text"  name="email" value="{{ $user->email }}" class="form-control" placeholder="" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Role</label>
                            <div class="col-sm-8">
                                <input type="text"  value="{{ $user->role_id }}" class="form-control" placeholder="" disabled>
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

