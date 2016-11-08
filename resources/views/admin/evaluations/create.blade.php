@extends('layouts.admin')

@section('content')
 <section class="content-header">
        <h1>
            Nueva Evaluación
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'evaluations.store', 'files' => true]) !!}

                              @include('admin.evaluations.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
