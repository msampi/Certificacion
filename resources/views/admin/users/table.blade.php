
<table class="table table-bordered table-striped search-table" id="users-table">
    <thead>
        <th width="5%"></th>
        <th>Codigo</th>
        <th>Nombre</th>
        <th>Email}</th>
        <th>Cliente</th>
        <th>Idioma</th>
        <th width="10%">Acción</th>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td><img src={!! URL('/uploads/'.$user->image) !!} width="50" height="50" /></td>
            <td>{!! $user->code !!}</td>
            <td>{!! $user->name !!} {!! $user->last_name !!}</td>
            <td>{!! $user->email !!}</td>
            <td>{!! $user->client->name or '' !!}</td>
            <td>{!! $user->language->name or '' !!}</td>

            <td>
                {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                {{-- */ $confirm = 'Esta seguro de eliminar este usuario?' /* --}}
                <a href="{!! route('users.edit', [$user->id]) !!}" class='btn btn-default btn-sm'><i class="glyphicon glyphicon-edit"></i></a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('$confirm')"]) !!}</td>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
