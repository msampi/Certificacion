@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>
            Editar Ejercicio
        </h1>
    </section>
    <div class="content">
       @include('adminlte-templates::common.errors')
        @include('flash::message')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($exercise, ['route' => ['exercises.update', $exercise->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('admin.exercises.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
    </div>
@endsection