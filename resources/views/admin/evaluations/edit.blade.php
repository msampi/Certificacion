@extends('layouts.admin')

@section('content')


   <section class="content-header">
      @include('flash::message')
           <h1>
               Editar Evaluación
           </h1>
       <h1 class="pull-right inside">
           <a class="btn btn-primary pull-right"  href="{!! route('evaluationUser.index', 'search='.$evaluation->id) !!}">Asignacion de usuarios</a>
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">

           <div class="box-body">
               <div class="row">
                   {!! Form::model($evaluation, ['route' => ['evaluations.update', $evaluation->id], 'method' => 'patch', 'files' => true, 'id' => 'evForm']) !!}

                    @include('admin.evaluations.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection