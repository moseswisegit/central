@extends('layouts.auth')

@section('content')

<div class="login-box">
    <div class="login-logo">
      <a href="#""><b>Admin</b>LTE</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
  
  
      <div class="card-body login-card-body">
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> @lang('quickadmin.qa_there_were_problems_with_input'):
            <br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <p class="login-box-msg">Se connecter</p>
  
        <form action="{{ url('login') }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="input-group mb-3">
            {{-- <input type="email" class="form-control" name="email" value="{{ old('email') }}"> --}}
            <input type="text" class="form-control" name="identifiant" value="{{ old('identifiant') }}">

            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="icheck-primary">
                <label>
                    <input type="checkbox" name="remember"> @lang('quickadmin.qa_remember_me')
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-6">
              <button type="submit" class="btn btn-primary btn-block"> @lang('quickadmin.qa_login')
            </button>
            </div>
            <!-- /.col -->
          </div>
        </form>
  
    
        <!-- /.social-auth-links -->
  
        <p class="mb-1">
            {{-- <a href="{{ route('auth.password.reset') }}">@lang('quickadmin.qa_forgot_password')</a> --}}
        </p>
        <p class="mb-0">
            {{-- <a href="{{ route('auth.register') }}">@lang('quickadmin.qa_registration')</a> --}}
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
@endsection