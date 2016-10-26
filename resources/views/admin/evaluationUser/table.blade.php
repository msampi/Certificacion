<table class="table table-bordered table-striped search-table" id="evaluations-table">
    <thead>
        <th>{!! $dictionary->translate('Nombre Usuario') !!}</th>
        <th>{!! $dictionary->translate('Email Usuario') !!}</th>
        <th>{!! $dictionary->translate('Puesto Usuario') !!}</th>
        <th>{!! $dictionary->translate('Categoria Usuario') !!}</th>
        <th>{!! $dictionary->translate('Nombre Evaluador') !!}</th>
        <th>{!! $dictionary->translate('Email Evaluador') !!}</th>
        <th width="10%">{!! $dictionary->translate('Acción') !!}</th>
    </thead>
    <tbody>
    @foreach($evaluation_users as $evaluation)
        <tr>
            <td>{!! $evaluation->user->name or '' !!} {!! $evaluation->user->last_name or '' !!}</td>
            <td>{!! $evaluation->user->email or '' !!}</td>
            <td>@if ($evaluation->post) {!! $evaluation->post->getName() !!} @endif</td>
            <td>{!! $evaluation->category !!}</td>
            <td>{!! $evaluation->evaluator['name'] !!} {!! $evaluation->evaluator['last_name'] !!}</td>
            <td>{!! $evaluation->evaluator['email'] !!}</td>

            <td>
                {!! Form::open(['route' => ['admin.evaluationUserEvaluators.destroy', $evaluation->id], 'method' => 'delete']) !!}
                 <a href="{!! route('admin.evaluationUserEvaluators.edit', [$evaluation->id]) !!}" class='btn btn-default btn-sm' data-toggle="tooltip" data-placement="top" title="Editar / Administrar"><i class="glyphicon glyphicon-edit"></i></a>
                {{-- */ $confirm = $dictionary->translate('Esta seguro de eliminar este usuario?') /* --}}
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('$confirm')"]) !!}

                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
