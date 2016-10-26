<table class="table table-bordered search-table" id="trackings-table">
    <thead>
        <th>{!! $dictionary->translate('Usuario') !!}</th>
        <th>{!! $dictionary->translate('Email usuario') !!}</th>
        <th>{!! $dictionary->translate('Evaluación') !!}</th>
        <th>{!! $dictionary->translate('Cliente') !!}</th>
        <th colspan="3">{!! $dictionary->translate('Acción') !!}</th>
    </thead>
    <tbody>
    @foreach($trackings as $tracking)
        <tr>
            <td>{!! $tracking->user->name !!} {!! $tracking->user->last_name !!}</td>
            <td>{!! $tracking->user->email !!}</td>
            <td>{!! $tracking->evaluation->name !!}</td>
            <td>{!! $tracking->user->client->name !!}</td>
            <td>
                {!! Form::open(['route' => ['admin.trackings.destroy', $tracking->id], 'method' => 'delete']) !!}

                    <a href="{!! route('admin.trackings.show', [$tracking->id]) !!}" class='btn btn-default btn-sm'><i class="glyphicon glyphicon-eye-open"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Are you sure?')"]) !!}

                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
