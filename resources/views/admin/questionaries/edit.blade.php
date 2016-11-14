@extends('layouts.admin')

@section('content')
   <section class="content-header">
           <h1>
               Editar Cuestionario
           </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">

           <div class="box-body">
               <div class="row">
                   {!! Form::model($questionary, ['route' => ['questionaries.update', $questionary->id], 'method' => 'patch']) !!}

                    @include('admin.questionaries.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection