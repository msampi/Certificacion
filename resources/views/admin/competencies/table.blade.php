<table class="table table-bordered table-striped search-table" id="competencies-table">
    <thead>
        <th width="2%">ID</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Cliente</th>
        <th width="10%">Acción</th>
    </thead>
    <tbody>
    @foreach($competencies as $competency)
        <tr>
            <td>@if ($competency->import_id > 0) {!! $competency->import_id !!} @else - @endif</td>
            <td>{!! $competency->name !!}</td>
            <td>{!! $competency->description !!}</td>
            <td>@if ($competency->client) {!! $competency->client->name !!} @else Todos @endif</td>
            <td>
                {!! Form::open(['route' => ['competencies.destroy', $competency->id], 'method' => 'delete']) !!}
                
                 <a href="{!! route('competencies.edit', [$competency->id]) !!}" class='btn btn-default btn-sm'><i class="glyphicon glyphicon-edit"></i></a>
                {{-- */ $confirm = 'Esta seguro de eliminar esta competencia?' /* --}} 
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('$confirm')"]) !!}
            
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>