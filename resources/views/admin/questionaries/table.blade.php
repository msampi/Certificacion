<table class="table table-bordered search-table" id="questionaries-table">
    <thead>
        <th width="2%">ID</th>
        <th>Nombre</th>
        <th>Cliente</th>
        <th width="10%">Acción</th>
    </thead>
    <tbody>
    @foreach($questionaries as $questionary)
        <tr>
            <td>@if ($questionary->import_id > 0) {!! $questionary->import_id !!} @else - @endif</td>
            <td>{!! $questionary->name !!}</td>
            <td>@if ($questionary->client) {!! $questionary->client->name !!} @else Todos @endif</td>
            <td>
                {!! Form::open(['route' => ['questionaries.destroy', $questionary->id], 'method' => 'delete']) !!}
                
                    <a href="{!! route('questionaries.edit', [$questionary->id]) !!}" class='btn btn-default btn-sm'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Esta seguro de eliminar este cuestionario?')"]) !!}
               
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>