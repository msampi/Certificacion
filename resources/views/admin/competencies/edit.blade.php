@extends('layouts.admin')

@section('content')
   <section class="content-header">
           <h1>
               Editar Competencia
           </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">

           <div class="box-body">
               <div class="row">
                   {!! Form::model($competency, ['route' => ['competencies.update', $competency->id], 'method' => 'patch']) !!}

                    @include('admin.competencies.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection