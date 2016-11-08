@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Asignacion de usuarios en: {!! $evaluation->name !!}  </h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right"  href="{!! route('evaluationUser.create', 'search='.$evaluation->id) !!}">Asignar Usuarios</a>
            <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! url( 'evaluations/'.$evaluation->id.'/edit' ) !!}">Volver a la Evaluación</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('admin.evaluationUser.table')
            </div>
        </div>
    </div>
@endsection

