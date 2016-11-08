@extends('layouts.admin')

@section('content')
 <section class="content-header">
        <h1>
            Nueva Competencia
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'competencies.store']) !!}

                              @include('admin.competencies.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
