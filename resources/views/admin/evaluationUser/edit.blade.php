@extends('layouts.app')

@section('content')
   <section class="content-header">
           <h1>
               {!! $dictionary->translate('Evaluación')!!}
           </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">

           <div class="box-body">
               <div class="row">
                   {!! Form::model($eue, ['route' => ['admin.evaluationUserEvaluators.update', $eue->id], 'method' => 'patch']) !!}

                    @include('admin.evaluationUserEvaluators.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection