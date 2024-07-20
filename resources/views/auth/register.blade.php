@extends('layouts.auth')

@section('content')
   

    <div class="register-box">
        <div class="register-logo">
          <a href="#"><b>Admin</b>LTE</a>
        </div>
      
        <div class="card">
          <div class="card-body register-card-body">
            <p class="login-box-msg">S'enrégistrer</p>
      
            <form action="{{ url('/register') }}"" method="post">

              <div class="input-group mb-3 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-user"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                @if ($errors->has('email'))
                <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif


                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3 {{ $errors->has('password') ? ' has-error' : '' }}">
                <input id="password" type="password" class="form-control" name="password" required>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
                @if ($errors->has('password'))
                <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
              </div>
              <div class="input-group mb-3">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                {{-- <div class="col-8">
                  <div class="icheck-primary">
                    <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                    <label for="agreeTerms">
                     I agree to the <a href="#">terms</a>
                    </label>
                  </div>
                </div> --}}
                <!-- /.col -->
                <div class="col-4">
                  <button type="submit" class="btn btn-primary btn-block"> @lang('quickadmin.qa_register')</button>
                </div>
                <!-- /.col -->
              </div>
            </form>
      
            
      
            <a href="{{ url('/dashboard/home') }}" class="text-center">I already have a membership</a>
          </div>
          <!-- /.form-box -->
        </div><!-- /.card -->
      </div>
@endsection
