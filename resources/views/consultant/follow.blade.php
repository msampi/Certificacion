@extends('layouts.consultant')

@section('content')


    <div class="col-md-12">
      <h2>Feedback </h2>
    </div>
    <div class="col-md-12">
       <div class="box box-solid">
            <div class="box-header with-border">
              <i class="fa fa-user"></i>

              <h3 class="box-title">Feedback para <strong>{!! $competitor->name !!} {!! $competitor->last_name !!}</strong> en <strong>{!! $exercise->name !!}</strong></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              {!! Form::textarea('feedback_1', null, ['class' => 'form-control textarea']) !!}
              {!! Form::textarea('feedback_2', null, ['class' => 'form-control textarea']) !!}
                
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
    </div>

@endsection
