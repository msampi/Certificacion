<table class="table table-bordered search-table" id="messages-table">
    <thead>
        <th>Asunto</th>
        <th width="10%">Acción</th>
    </thead>
    <tbody>
    @foreach($messages as $message)
        <tr>
            <td>{!! substr($message->subject, 0, 300) !!}...</td>
            <td>
                {!! Form::open(['route' => ['messages.destroy', $message->id], 'method' => 'delete']) !!}
                {{-- */ $confirm = 'Esta seguro de eliminar este mensaje?' /* --}}

                    <a href="{!! route('messages.edit', [$message->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('$confirm')"]) !!}

                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
