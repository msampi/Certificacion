@extends('layouts.competitor')

@section('content')

    {!! Form::open(['id' => 'form']) !!}
    <div class="col-md-12">
      <h2>{!! $exercise->name !!} </h2>
      <p>{!! $exercise->instructions !!}</p>
      @foreach ($exercise->questionaries as $questionary)
        <table class="table table-bordered">
            <thead>
                <th >{!! $questionary->name !!}</th>
            </thead>
            <tbody>
                    @foreach ($questionary->questions as $question)
                    <tr>
                        <td style="background-color:#eee; ">{!! $question->question !!}</td>
                    </tr>
                    <tr>
                        <td style="background-color:white;">
                        @if (!$question->options->isEmpty())
                            @foreach ($question->options as $option)
                                <span class="vt-middle">{!! $option->option !!}</span> <input  type="checkbox" class="check-big" name="option[{!! $question->id !!}][{!! $option->id !!}]" value="{!! $option->id !!}" 
                                @if ($questionReviewRepository->isOptionChecked($question->id, Auth::user()->id, $exercise->id, $option->id, $option->id)) checked @endif><br><br>
                            @endforeach
                        @else
                            <textarea class="form-control" name="option[{!! $question->id !!}][]">@if ($answer = $questionReviewRepository->getAnswer($question->id, Auth::user()->id, $exercise->id)){!! $answer; !!}@endif</textarea>
                        @endif
                        </td>
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
                knowledgeSave();
            }, 2000);
        })

    </script>


@endsection
