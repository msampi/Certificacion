@extends('layouts.login')

@section('content')


<form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
    {!! csrf_field() !!}

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label class="control-label">E-Mail</label>
        <input type="email" class="form-control" name="email" value="{{ old('email') }}">

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

    <div class="form-group">
        <div class="col-md-6">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember"> Recordarme
                </label>
            </div>
        </div>
        <div class="col-md-6">
             <button type="submit" class="btn btn-primary">
                <i class="fa fa-btn fa-sign-in"></i> Ingresar
            </button>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-12 ">
            <a class="btn btn-link" href="{{ url('/password/reset') }}">Olvidó su contraseña?</a>
        </div>
    </div>
</form>


@endsection
