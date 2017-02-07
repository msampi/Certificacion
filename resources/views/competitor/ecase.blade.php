@extends('layouts.competitor')

@section('content')


    <div class="col-md-12">
      <h2>{!! $exercise->name !!} </h2>
      <p>{!! $exercise->instructions !!}</p>
      <h3>
        <a target="_BLANK" href="{!! url('/competitor/ecase/connect/'.$exercise->id) !!}">Haga clic aqui para comenzar el ejercicio en la plataforma de E-Cases</a>
        
      </h3>
    </div>
    <div class="col-md-12 mt20">
        <a href="{{ url('/competitor') }}" class="btn btn-default">Volver</a>
    </div>

@endsection
