@extends('layouts.admin')

@section('content')
   <section class="content-header">
           <h1>
               Editar Cuestionario de Autopercepción
           </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">

           <div class="box-body">
               <div class="row">
                   {!! Form::model($autoperception, ['route' => ['autoperceptions.update', $autoperception->id], 'method' => 'patch']) !!}

                    @include('admin.autoperceptions.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection