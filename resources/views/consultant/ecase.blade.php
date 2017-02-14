@extends('layouts.consultant')

@section('content')
    {!! Form::open(['id' => 'form']) !!}
    <div class="col-md-12">
      <h2>{!! $exercise->name !!} </h2>
    </div>
    <div class="col-md-12">
       <div class="box box-solid">
            <div class="box-header with-border">
              
              <div class="col-md-7">
                <h3 class="box-title"><i class="fa fa-user"></i> Seguimiento para <strong>{!! $competitor->name !!} {!! $competitor->last_name !!}</strong></h3>
              </div>
              <div class="col-md-2">
                <span id="saving-label" class="pull-right">Guardando...</span>
              </div>
              <div class="col-md-3">
                <a href="{!! url('/consultant/roleplay/'.$exercise->id.'/'.$competitor->id.'/'.$alt_consultant_id) !!}"  class="btn btn-default pull-right">Ver actividad de consultor {{ $consultant_label }}</a>
              </div>
            </div>
           
            
            <!-- /.box-header -->
            <div class="box-body">
                <div class="col-md-12">
                    <h3>Resolución de ejercicios en Plataforma E-cases</h3>
                    <h4>Simulación: {{ $exercise->simulation_name }}</h4>
                    <h3>Agenda</h3>
                    @foreach ($ecaseDiary as $diary)
                    <table class="table table-bordered">
                        <tr>
                            <th colspan="3">{!! $diary->tema !!}</th>
                        </tr>
                        <tr>
                            <td class="gray-td">Importancia: {!! $diary->importancia !!}</td>
                            <td class="gray-td">Desde: {!! $diary->fecha_desde !!}</td>
                            <td class="gray-td">Hasta: {!! $diary->fecha_hasta !!}</td>    
                        </tr>
                        <tr>
                            <td colspan="3" class="dark-gray-td">Procedimiento</td>
                        </tr>
                        <tr>
                            <td colspan="3">{!! $diary->procedimiento !!}</td>
                        </tr>
                    </table>            
                    @endforeach
                    <h3>Toma de Decisión</h3>
                    
                    @foreach ($ecaseDecision as $decision)
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>{{ $decision->nombre}}</th>
                        </tr>
                        @foreach ($decision->questions as $question)
                        <tr>
                            <td>{!! $question->titulo !!}</td>
                        </tr>
                        <tr>
                            <td>{!! $question->answer->respuesta !!}</td>
                        </tr>
                        @endforeach
                    </table>         
                    @endforeach
                    <h3>Escribir al director</h3>
                    {!! $ecaseWrite->texto !!}
                </div>
                <div class="col-md-12">
                    <h3>Competencias</h3>  
                    @foreach ($exercise->competencyGroups as $competency_group)
                    <h4>{!! $competency_group->name !!}</h4>
                    @foreach ($competency_group->competencies as $competency)
                    <table class="table table-bordered">
                        <thead>
                            <th colspan="100">{!! $competency->name !!}</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                @foreach ($exercise->rating->values as $value)
                                    <td width="10px" class="middle"><label class="">{!! $value->name !!}</label></td> 
                                @endforeach
                                <td></td>
                            </tr>
                            @foreach ($competency->items as $item)
                                <tr>
                                    <td>{!! $item->positive !!}</td>
                                    @foreach ($exercise->rating->values as $value)
                                       <td class="gray"><input {{ $disabled }} type="radio" value="{!! $value->value !!}" name="competency_item[{!! $competency->id !!}][{!! $item->id !!}]" @if ($consultantReview) @if($consultantReview->isChecked($competency->id, $item->id, $value->value )) checked @endif @endif></td>
                                    @endforeach
                                    <td>{!! $item->negative !!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endforeach
                    @endforeach
                    <h3>Feedback</h3> 
                     {!! Form::textarea('feedback_1', null, ['class' => 'form-control textarea']) !!}
                </div>
            
            </div>
            <!-- /.box-body -->
          </div>
    </div>
    {!! Form::close() !!}
    <div class="col-md-12 mt20">
        <a href="{{ url('/consultant/progress/'.$exercise->id) }}" class="btn btn-default">Volver</a>
    </div>
    <script type="text/javascript">
        var data = {
            'competitor_id': '{!! $competitor->id !!}',
            'exercise_id': '{!! $exercise->id !!}',
            'consultant_id': '{!! $consultant_id !!}',
            'consultant_type': '{!! $is_primary_consultant!!}'
        }
        $(function(){
            setInterval(function() {
                exerciseSave();
            }, 2000);
        })

    </script>

   
@endsection
