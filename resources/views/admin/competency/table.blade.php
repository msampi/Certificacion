<table class="table table-bordered table-striped search-table" id="competitions-table">
    <thead>
        <th>{!! $dictionary->translate('Nombre') !!}</th>
        <th>{!! $dictionary->translate('Descripción') !!}</th>
        <th>{!! $dictionary->translate('Puesto') !!}</th>
        <th width="10%">{!! $dictionary->translate('Acción') !!}</th>
    </thead>
    <tbody>
    @foreach($competitions as $competition)
        <tr>
            <td>{!! $competition->getName() !!}</td>
            <td>{!! $competition->getDescription() !!}</td>
            <td>@if ($competition->post) {!! $competition->post->getName() !!} @endif</td>
            <td>
                {!! Form::open(['route' => ['admin.competitions.destroy', $competition->id], 'method' => 'delete']) !!}
                
                 <a href="{!! route('admin.competitions.edit', [$competition->id]) !!}" class='btn btn-default btn-sm'><i class="glyphicon glyphicon-edit"></i></a>
                {{-- */ $confirm = $dictionary->translate('Esta seguro de eliminar esta competencia?') /* --}} 
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('$confirm')"]) !!}
            
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>