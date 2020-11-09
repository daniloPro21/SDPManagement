@extends('layouts.log')

@section('content')
<div class="login-box">
    <center><img src="{{ asset('dist/img/logo.png') }}" width="100px" height="100px" alt=""></center>
    <div class="login-logo">
      <a href="../../index2.html"><b>SDP</b>Mangement</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group has-feedback">
            <label for="email">Email</label>
          <input id="email" placeholder="Email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          @error('email')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
         @enderror
        </div>
        <div class="form-group has-feedback">
            <label for="password"> Mot de passe</label>
          <input id="password" placeholder="*********" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          @error('password')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
         @enderror
        </div>
        <div class="row">
          <div class="col-xs-8">
            <div class="checkbox icheck">
                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                    <input type="checkbox">
                </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.login-box-body -->
  </div>
@endsection
<!-- /.login-box -->
