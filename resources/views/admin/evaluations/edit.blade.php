@extends('layouts.app')

@section('content')


   <section class="content-header">
      @include('flash::message')
           <h1>
               {!! $dictionary->translate('Evaluación')!!}
           </h1>
           <h1 class="pull-right inside">
              <!--<a href="{!! route('admin.evaluations.index', 'search=3') !!}" class='btn btn-primary pull-right'>{!! $dictionary->translate('Plan de acción') !!}</a> --> 
              <a href="{!! route('admin.plans.index', 'search='.$evaluation->id) !!}" class='btn btn-primary pull-right'>{!! $dictionary->translate('PDP') !!}</a>
              <a href="{!! route('admin.objectives.index', 'search='.$evaluation->id) !!}" class='btn btn-primary pull-right'>{!! $dictionary->translate('Objetivos') !!}</a>
              <a href="{!! route('admin.competitions.index', 'search='.$evaluation->id) !!}" class='btn btn-primary pull-right'>{!! $dictionary->translate('Competencias') !!}</a>
              <a href="{!! route('admin.valorations.index', 'search='.$evaluation->id) !!}" class='btn btn-primary pull-right'>{!! $dictionary->translate('Valoraciones') !!}</a>
              <a href="{!! route('admin.posts.index', 'search='.$evaluation->id) !!}" class='btn btn-primary pull-right'>{!! $dictionary->translate('Puestos') !!}</a>
              <a href="{!! route('admin.evaluationUserEvaluators.index', 'search='.$evaluation->id) !!}" class='btn btn-primary pull-right'>{!! $dictionary->translate('Usuarios') !!}</a>  
          </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">

           <div class="box-body">
               <div class="row">
                   {!! Form::model($evaluation, ['route' => ['admin.evaluations.update', $evaluation->id], 'method' => 'patch', 'files' => true]) !!}

                    @include('admin.evaluations.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection