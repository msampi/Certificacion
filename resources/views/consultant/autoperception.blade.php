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
                    <h3>Autopercepción de <strong>{!! $competitor->name !!} {!! $competitor->last_name !!}</strong></h3>
                    @foreach ($exercise->autoperceptions as $autoperception)
                    <table class="table table-bordered">
                        <thead style="background-color:#3c8dbc; color:white">
                            <th >{!! $autoperception->name !!}</th>
                             @foreach ($autoperception->rating->values as $value)
                                <th width="10px" style="background-color:#3c8dbc; color:white"><label class="">{!! $value->name !!}</label></th> 
                            @endforeach
                        </thead>
                        <tbody>
                            <tr ><td colspan="100" style="background-color:#eee">{!! $autoperception->instructions !!}</td></tr>
                                @foreach ($autoperception->items as $item)
                                <tr>
                                    <td style="background-color:white;">{!! $item->description !!}</td>
                                    @foreach ($autoperception->rating->values as $value)

                                        <td style="background-color:#eee; text-align:center">
                                            <input disabled type="radio" name="item[{!! $item->id !!}]" value="{!! $value->value !!}"
                                            @if ($autoperceptionReviewRepository->isChecked($item->id, $competitor->id, $exercise->id, $value->value))
                                                    checked
                                            @endif >
                                        </td>

                                    @endforeach
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                    @endforeach
                    <h3>Competencias</h3>
                    @foreach ($exercise->competencyGroups as $competency_group)
                    <h4>{!! $competency_group->name !!}</h4>
                        @foreach ($competency_group->competencies as $competency)
                        <table class="table table-bordered">
                            <thead >
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
                                            <td class="gray"><input {{ $disabled }}  type="radio" value="{!! $value->value !!}" name="competency_item[{!! $competency->id !!}][{!! $item->id !!}]" @if ($consultantReview) @if($consultantReview->isChecked($competency->id, $item->id, $value->value )) checked @endif @endif></td>
                                        @endforeach
                                        <td>{!! $item->negative !!}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endforeach
                    @endforeach
                    @if ($exercise->competencyGroups->isEmpty())
                         <div class="alert alert-danger" role="alert">Este ejercicio no tiene competencias</div>
                    @endif
                    
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
