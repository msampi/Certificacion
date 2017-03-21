@extends('layouts.competitor')

@section('content')


    <div class="col-md-12">
      <h2>{!! $exercise->name !!} </h2>
      <p>{!! $exercise->instructions !!}</p>
    <h3>
        @if ($exercise->competitor_pdf != '')
            <a target="_BLANK" href="{!! url('/uploads/'.$exercise->competitor_pdf) !!}">Haga clic aqui para visualizar el archivo adjunto.</a></h3>
        @else
            <div class="alert alert-danger" role="alert">Este ejercicio no tiene un archivo asociado</div>
        @endif
    </div>
    <div class="col-md-12 mt20">
        <a href="{{ url('/competitor') }}" class="btn btn-default">Volver</a>
    </div>


@endsection
