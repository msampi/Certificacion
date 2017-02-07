@extends('layouts.competitor')

@section('content')

    {!! Form::open(['id' => 'form']) !!}
    <div class="col-md-12">
      <h2>{!! $exercise->name !!} </h2>
      <p>{!! $exercise->instructions !!}</p>
      
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
                                <input type="radio" name="item[{!! $item->id !!}]" value="{!! $value->value !!}"
                                @if ($autoperceptionReviewRepository->isChecked($item->id, Auth::user()->id, $exercise->id, $value->value))
                                        checked
                                @endif >
                            </td>
                        
                        @endforeach
                    </tr>
                    @endforeach
            </tbody>
        </table>
        @endforeach
    </div>
    {!! Form::close() !!}
    <div class="col-md-12 mt20">
        <a href="{{ url('/competitor') }}" class="btn btn-default">Volver</a>
    </div>
    <script type="text/javascript">
        var exercise_id = {!! $exercise->id !!};
        $(function(){
            setInterval(function() {
                autoperceptionSave();
            }, 2000);
        })

    </script>


@endsection
