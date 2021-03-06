@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Evaluaciones</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right"  href="{!! route('evaluations.create') !!}">Nueva Evaluación</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('admin.evaluations.table')
            </div>
        </div>
    </div>
@endsection

