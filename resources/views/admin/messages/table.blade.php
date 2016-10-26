<table class="table table-bordered search-table" id="messages-table">
    <thead>
        <th>{!! $dictionary->translate('Asunto') !!}</th>
        <th width="10%">{!! $dictionary->translate('Acción') !!}</th>
    </thead>
    <tbody>
    @foreach($messages as $message)
        <tr>
            <td>{!! $message->subject[1] !!}</td>
            <td>
                {!! Form::open(['route' => ['admin.messages.destroy', $message->id], 'method' => 'delete']) !!}
                {{-- */ $confirm = $dictionary->translate('Esta seguro de eliminar este mensaje?') /* --}}

                    <a href="{!! route('admin.messages.edit', [$message->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('$confirm')"]) !!}

                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
