@extends('layouts.admin')

@section('content')
 <section class="content-header">
        <h1>
            Nueva Cuestionario de Autopercepción
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'autoperceptions.store']) !!}

                              @include('admin.autoperceptions.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
