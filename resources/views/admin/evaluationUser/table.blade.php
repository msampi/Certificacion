<table class="table table-bordered table-striped search-table" id="evaluations-table">
    <thead>
        <th>Participante</th>
        <th>Participante email</th>
        <th>Consultor Primario</th>
        <th>Consultor Secundario</th>
        <th>Status</th>
        <th width="10%">Acción</th>
    </thead>
    <tbody>
    @foreach($evaluation_users as $evaluation)
        <tr>
            <td>{!! $evaluation->competitor->name !!} {!! $evaluation->competitor->last_name !!}</td>
            <td>{!! $evaluation->competitor->email !!}</td>
            <td>{!! $evaluation->primaryConsultant->name !!} {!! $evaluation->primaryConsultant->last_name !!}</td>
            <td>{!! $evaluation->secondaryConsultant->name !!} {!! $evaluation->secondaryConsultant->last_name !!}</td>
            <td>status</td>
            

            <td>
                {!! Form::open(['route' => ['evaluationUser.destroy', $evaluation->id], 'method' => 'delete']) !!}
                 <a href="{!! route('evaluationUser.edit', [$evaluation->id]) !!}" class='btn btn-default btn-sm' data-toggle="tooltip" data-placement="top" title="Editar / Administrar"><i class="glyphicon glyphicon-edit"></i></a>
                {{-- */ $confirm ='Esta seguro de eliminar esta asignación?' /* --}}
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('$confirm')"]) !!}

                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
