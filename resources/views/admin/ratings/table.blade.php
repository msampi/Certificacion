<table class="table table-bordered table-striped search-table" id="ratings-table">
    <thead>
        <th>Nombre</th>
        <th width="10%">Acción</th>
    </thead>
    <tbody>
    @foreach($ratings as $rating)
        <tr>
            <td>{!! $rating->name !!}</td>
            <td>
                {!! Form::open(['route' => ['ratings.destroy', $rating->id], 'method' => 'delete']) !!}
               
                    <a href="{!! route('ratings.edit', [$rating->id]) !!}" class='btn btn-default btn-sm'><i class="glyphicon glyphicon-edit"></i></a>
                    {{-- */ $confirm = 'Esta seguro de eliminar este rating?' /* --}} 
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('$confirm')"]) !!}
                
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>