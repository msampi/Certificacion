@extends('layouts.app-full')

@section('content')
<section class="content">
      <div class="error-page">
        <h2 class="headline text-yellow"> 404</h2>
        <div class="error-content" style="padding-top: 20px;">
          <h3><i class="fa fa-warning text-yellow"></i> Evaluacion no encontrada</h3>
          <p>
            El usuario con el que intenta ingresar no tiene asignada una evaluacion por el momento.
            Contacte con el administrador del sistema para resolver el problema.
          </p>
          <p>En caso de que el problema este resuelto recargue esta pagina o presione <a href="{{ URL('/logout') }}">aqui</a> para volver a ingresar</p>
        </div>
      </div>
      </section>
@endsection
    
