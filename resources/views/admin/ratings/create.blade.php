@extends('layouts.admin')

@section('content')
 <section class="content-header">
        <h1>
            Nuevo Rating
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'ratings.store']) !!}

                              @include('admin.ratings.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
