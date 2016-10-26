@extends('layouts.login')

<!-- Main Content -->
@section('content')


@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
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

    <div class="form-group">
        <div class="col-md-6 col-md-offset-2">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-btn fa-envelope"></i> Enviar link de restauracion
            </button>
        </div>
    </div>
</form>

@endsection
