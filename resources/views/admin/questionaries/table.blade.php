<table class="table table-bordered search-table" id="questionaries-table">
    <thead>
        <th>Nombre</th>
        <th width="10%">Acción</th>
    </thead>
    <tbody>
    @foreach($questionaries as $questionary)
        <tr>
            <td>{!! $questionary->name !!}</td>
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