<!-- Title Field -->
<div class="form-group col-sm-8">

	{!! Form::label('subject', 'Asunto: ') !!}
    {!! Form::text('subject', null, ['class' => 'form-control']) !!}

</div>

<div class="form-group col-sm-4 ">
      {!! Form::label('client', 'Cliente:') !!}
      {!! Form::select('client_id',  $clients, null,  ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">

	{!! Form::label('from', 'De:') !!}
    {!! Form::text('from', null, ['class' => 'form-control']) !!}

</div>

<!-- Message Field -->
<div class="form-group col-sm-12">
    
    {!! Form::label('message', 'Mensaje:') !!}	
    {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
    
</div>

<div class="col-md-12">
	<table class="table table-bordered">
	    <thead>
	        <th width="20%">Palabra Reservada</th>
	        <th>Descripción</th>
	    </thead>
	    <tbody>
	    <tr>
				<td>user_name</td>
				<td>Nombre de usuario.</td>
	    </tr>
			<tr>
				<td>user_last_name</td>
				<td>Apellido de usuario.</td>
	    </tr>
			<tr>
				<td>user_email</td>
				<td>Email de usuario.</td>
	    </tr>
			<tr>
				<td>user_password</td>
				<td>Contraseña de usuario.</td>
	    </tr>
			<tr>
				<td>client_name</td>
				<td>Nombre de cliente.</td>
	    </tr>
			<tr>
				<td>web_link</td>
				<td>Link de acceso a la plataforma.</td>
	    </tr>
			<tr>
				<td>evaluation_name</td>
				<td>Nombre de la evaluación.</td>
	    </tr>
	    </tbody>
	</table>

</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('messages.index') !!}" class="btn btn-default">Cancelar</a>
</div>
