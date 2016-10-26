@extends('layouts.login')

@section('content')

  <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
      {!! csrf_field() !!}

      <input type="hidden" name="token" value="{{ $token }}">

      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
          <label class="control-label">E-Mail</label>
          <input type="email" class="form-control" name="email" value="{{ $email or old('email') }}">

          @if ($errors->has('email'))
              <span class="help-block">
                  <strong>{{ $errors->first('email') }}</strong>
              </span>
          @endif

      </div>

      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
          <label class="control-label">Contraseña</label>
          <input type="password" class="form-control" name="password">

          @if ($errors->has('password'))
              <span class="help-block">
                  <strong>{{ $errors->first('password') }}</strong>
              </span>
          @endif

      </div>

      <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
          <label class="control-label">Confirmar Contraseña</label>
          <input type="password" class="form-control" name="password_confirmation">

          @if ($errors->has('password_confirmation'))
              <span class="help-block">
                  <strong>{{ $errors->first('password_confirmation') }}</strong>
              </span>
          @endif

      </div>

      <div class="form-group">
          <div class="col-md-6 col-md-offset-4">
              <button type="submit" class="btn btn-primary">
                  <i class="fa fa-btn fa-sign-in"></i> Ingresar
              </button>
          </div>
      </div>
  </form>

@endsection
