<table class="table table-bordered table-striped search-table" id="autoperceptions-table">
    <thead>
        <th width="2%">ID</th>
        <th>Nombre</th>
        <th>Cliente</th>
        <th width="10%">Acción</th>
    </thead>
    <tbody>
    @foreach($autoperceptions as $autoperception)
        <tr>
            <td>@if ($autoperception->import_id > 0) {!! $autoperception->import_id !!} @else - @endif</td>
            <td>{!! $autoperception->name !!}</td>
            <td>@if ($autoperception->client) {!! $autoperception->client->name !!} @else Todos @endif</td>
           
            <td>
                {!! Form::open(['route' => ['autoperceptions.destroy', $autoperception->id], 'method' => 'delete']) !!}
                
                 <a href="{!! route('autoperceptions.edit', [$autoperception->id]) !!}" class='btn btn-default btn-sm'><i class="glyphicon glyphicon-edit"></i></a>
                {{-- */ $confirm = 'Esta seguro de eliminar este cuestionario de autopercepción?' /* --}} 
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('$confirm')"]) !!}
            
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>