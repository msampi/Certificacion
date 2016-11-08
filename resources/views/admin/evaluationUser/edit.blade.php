@extends('layouts.admin')

@section('content')
   <section class="content-header">
           <h1>
               Editar Asignación
           </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">

           <div class="box-body">
               <div class="row">
                   {!! Form::model($evaluation, ['route' => ['evaluationUser.update', $evaluation->id], 'method' => 'patch']) !!}

                    @include('admin.evaluationUser.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection