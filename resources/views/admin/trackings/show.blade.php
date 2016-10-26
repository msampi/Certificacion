@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Tracking
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('admin.trackings.show_fields')
                    <a href="{!! route('admin.trackings.index') !!}" class="btn btn-default">{!! $dictionary->translate('Volver') !!}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
