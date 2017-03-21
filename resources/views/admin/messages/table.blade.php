<table class="table table-bordered search-table" id="messages-table">
    <thead>
        <th>Asunto</th>
        <th width="10%">Acción</th>
    </thead>
    <tbody>
    @foreach($messages as $message)
        <tr>
            <td>{!!$message->subject !!}</td>
            <td>
                {!! Form::open(['route' => ['messages.destroy', $message->id], 'method' => 'delete']) !!}
                {{-- */ $confirm = 'Esta seguro de eliminar este mensaje?' /* --}}

                    <a href="{!! route('messages.edit', [$message->id]) !!}" class='btn btn-default btn-sm'><i class="glyphicon glyphicon-edit"></i></a>
                    @if ($message->id != 1 && $message->id != 2)
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('$confirm')"]) !!}
                    @endif
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
