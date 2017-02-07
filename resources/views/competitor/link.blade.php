@extends('layouts.competitor')

@section('content')


    <div class="col-md-12">
      <h2>{!! $exercise->name !!} </h2>
      <p>{!! $exercise->instructions !!}</p>
    <h3><a target="_BLANK" href="{!! $exercise->external_link !!}">Haga clic aqui para seguir el enlace del ejercicio</a></h3>
    </div>
    <div class="col-md-12 mt20">
        <a href="{{ url('/competitor') }}" class="btn btn-default">Volver</a>
    </div>

@endsection
