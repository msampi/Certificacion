@extends('layouts.competitor')

@section('content')


    <div class="col-md-12">
      <h2>{!! $exercise->name !!} </h2>
      <p>{!! $exercise->instructions !!}</p>
    <h3><a target="_BLANK" href="{!! url('/uploads/'.$exercise->competitor_pdf) !!}">Haga clic aqui para visualizar el archivo adjunto.</a></h3>
    </div>
    <div class="col-md-12 mt20">
        <a href="{{ url('/competitor') }}" class="btn btn-default">Volver</a>
    </div>


@endsection
