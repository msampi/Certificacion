<table class="table table-bordered table-striped search-table" id="exercises-table">
    <thead>
        <th>Nombre</th>
        <th>Instrucciones</th>
        <th>Tipo</th>
        <th width="10%">Action</th>
    </thead>
    <tbody>
    @foreach($exercises as $exercise)
        <tr>
            <td>{!! $exercise->name !!}</td>
            <td>{!! $exercise->instructions !!}</td>
            <td>{!! $exercise->type->name !!}</td>
            <td>
                {!! Form::open(['route' => ['exercises.destroy', $exercise->id], 'method' => 'delete']) !!}
                
                    <a href="{!! route('exercises.edit', [$exercise->id]) !!}" class='btn btn-default btn-sm'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Esta seguro de eliminar este ejercicio?')"]) !!}
                
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>