<table class="table table-bordered table-striped search-table" id="clients-table">
    <thead>
        <th width="5%"></th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th width="10%">Acción</th>
    </thead>
    <tbody>
    @foreach($clients as $client)
        <tr>
            <td><img src={{ URL('/uploads/'.$client->logo) }} width="40" height="40" /></td>
            <td>{!! $client->name !!}</td>
            <td>{!! $client->description !!}</td>
            <td>
                {!! Form::open(['route' => ['clients.destroy', $client->id], 'method' => 'delete']) !!}
                  {{-- */ $confirm = 'Esta seguro de eliminar este cliente?' /* --}}
                    <a href="{!! route('clients.edit', [$client->id]) !!}" class='btn btn-default btn-sm'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('$confirm')"]) !!}

                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
