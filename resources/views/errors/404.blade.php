@extends('layouts.app-full')

@section('content')
<section class="content">
      <div class="error-page">
        <h2 class="headline text-yellow"> 405</h2>
        <div class="error-content" style="padding-top: 20px;">
          <h3><i class="fa fa-warning text-yellow"></i> Acceso denegado.</h3>
          <p>
            No tienen permisos de administrador para acceder a esta p&aacute;gina.
            Registre un usuario administrador desde la p&aacute;gina  <a href="{{ URL('/login') }}">Login</a> para acceder.
          </p>
        </div>
      </div>
      </section>
@endsection
    

