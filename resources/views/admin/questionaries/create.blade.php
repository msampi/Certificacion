@extends('layouts.admin')

@section('content')
 <section class="content-header">
        <h1>
           Nuevo Cuestionario
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'questionaries.store']) !!}

                              @include('admin.questionaries.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
