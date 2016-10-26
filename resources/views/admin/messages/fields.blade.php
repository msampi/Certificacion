<!-- Title Field -->
<div class="form-group col-sm-12 multilang-group">

	{!! Form::label('subject', $dictionary->translate('Asunto').': ') !!}
	@foreach ($languages as $language)

	    {!! Form::text('subject['.$language->id.']', null, ['class' => 'form-control multilang', 'data-lang' => $language->name, $disabled]) !!}

	@endforeach

</div>

<div class="form-group col-sm-12 ">
      {!! Form::label('client', $dictionary->translate('Cliente').':') !!}
      {!! Form::select('client_id',  $clients, null,  ['class' => 'form-control', $disabled]) !!}
</div>

<div class="form-group col-sm-12 multilang-group">

	{!! Form::label('from', $dictionary->translate('De').':') !!}
	@foreach ($languages as $language)

	    {!! Form::text('from['.$language->id.']', null, ['class' => 'form-control multilang', 'data-lang' => $language->name , $disabled]) !!}

	@endforeach

</div>

<!-- Message Field -->
<div class="form-group col-sm-12 multilang-group">
    {!! Form::label('message', $dictionary->translate('Mensaje').':') !!}
    @foreach ($languages as $language)
    	<div class="multilang" data-lang="{!! $language->name !!}">
    	{!! Form::textarea('message['.$language->id.']', null, ['class' => 'form-control textarea ', $disabled]) !!}
    	</div>

    @endforeach
</div>

<div class="col-md-12">
	<table class="table table-bordered">
	    <thead>
	        <th width="20%">{!! $dictionary->translate('Palabra Reservada') !!}</th>
	        <th>{!! $dictionary->translate('Descripción') !!}</th>
	    </thead>
	    <tbody>
	    <tr>
				<td>user_name</td>
				<td>{!! $dictionary->translate('Nombre de usuario') !!}.</td>
	    </tr>
			<tr>
				<td>user_last_name</td>
				<td>{!! $dictionary->translate('Apellido de usuario') !!}.</td>
	    </tr>
			<tr>
				<td>user_email</td>
				<td>{!! $dictionary->translate('Email de usuario') !!}.</td>
	    </tr>
			<tr>
				<td>user_password</td>
				<td>{!! $dictionary->translate('Contraseña de usuario') !!}.</td>
	    </tr>
			<tr>
				<td>client_name</td>
				<td>{!! $dictionary->translate('Nombre de cliente') !!}.</td>
	    </tr>
			<tr>
				<td>web_link</td>
				<td>{!! $dictionary->translate('Link de acceso a la plataforma') !!}.</td>
	    </tr>
			<tr>
				<td>evaluation_name</td>
				<td>{!! $dictionary->translate('Nombre de la evaluación') !!}.</td>
	    </tr>
	    </tbody>
	</table>

</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit($dictionary->translate('Guardar'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.messages.index') !!}" class="btn btn-default">{!! $dictionary->translate('Cancelar') !!}</a>
</div>
