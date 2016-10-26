<table class="table table-bordered table-striped search-table" id="evaluations-table">
    <thead>
        <th>{!! $dictionary->translate('Nombre') !!}</th>
        <th>{!! $dictionary->translate('Cliente') !!}</th>
        <th>{!! $dictionary->translate('Instrucciones') !!}</th>
        <th width="10%">{!! $dictionary->translate('Accion') !!}</th>
    </thead>
    <tbody>
    @foreach($evaluations as $evaluation)
        <tr>
            <td>{!! $evaluation->name !!}</td>
            <td>{!! $evaluation->client->name!!}</td>
            <td>{!! $evaluation->instructions !!}</td>

            <td>
                {!! Form::open(['route' => ['admin.evaluations.destroy', $evaluation->id], 'method' => 'delete']) !!}
                 <a href="{!! route('admin.evaluations.edit', [$evaluation->id]) !!}" class='btn btn-default btn-sm' data-toggle="tooltip" data-placement="top" title="Editar / Administrar"><i class="glyphicon glyphicon-edit"></i></a>
                 {{-- */ $confirm = $dictionary->translate('Esta seguro de eliminar esta evaluacion?') /* --}} 
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('$confirm')"]) !!}
               
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>