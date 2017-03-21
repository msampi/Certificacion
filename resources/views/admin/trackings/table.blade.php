<table class="table table-bordered search-table" id="trackings-table">
    <thead>
        <th>Rol</th>
        <th>Usuario</th>
        <th>Email usuario</th>
        <th>Evaluación</th>
        <th>Cliente</th>
        <th colspan="3">Acción</th>
    </thead>
    <tbody>
    @foreach($trackings as $tracking)
        <tr>
            <td>{!! $tracking->role->name !!}</td>
            <td>{!! $tracking->user->name !!} {!! $tracking->user->last_name !!}</td>
            <td>{!! $tracking->user->email !!}</td>
            <td>{!! $tracking->evaluation->name !!}</td>
            <td>{!! $tracking->user->client->name !!}</td>
            <td>
                {!! Form::open(['route' => ['trackings.destroy', $tracking->id], 'method' => 'delete']) !!}

                    <a href="{!! route('trackings.show', [$tracking->id]) !!}" class='btn btn-default btn-sm'><i class="glyphicon glyphicon-eye-open"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Esta seguro de eliminar este registro?')"]) !!}

                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
