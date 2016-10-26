
<div class="col-sm-8">
    <fieldset>
        <legend>Información Personal:</legend>

<div class="form-group col-sm-6">
    {!! Form::label('code', 'Codigo:') !!}
    {!! Form::text('code', null, ['class' => 'form-control']) !!}
</div>

<!-- First Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Nombre:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Last Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('last_name', 'Apellido:') !!}
    {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('dni', 'DNI:') !!}
    {!! Form::text('dni', null, ['class' => 'form-control']) !!}
</div>
</fieldset>
<fieldset>
    <legend>Información de Localidad:</legend>
    <div class="form-group col-sm-6">
        {!! Form::label('country', 'Pais:') !!}
        {!! Form::text('country', null, ['class' => 'form-control']); !!}
    </div>
    <div class="form-group col-sm-6">
        {!! Form::label('city', 'Ciudad:') !!}
        {!! Form::text('city', null, ['class' => 'form-control']); !!}
    </div>
    <div class="form-group col-sm-6">
        {!! Form::label('area', 'Area:') !!}
        {!! Form::text('area', null, ['class' => 'form-control']); !!}
    </div>
    <div class="form-group col-sm-6">
        {!! Form::label('department', 'Departamento:') !!}
        {!! Form::text('department', null, ['class' => 'form-control']); !!}
    </div>
</fieldset>

</div>
<div class="col-sm-4">
    <div class="box-body box-profile">
        <img id="image"  alt="User profile picture" src="@if (isset($user) && $user->image)  {!! asset('uploads/'.$user->image) !!} @else {!! asset('img/user.png') !!} @endif" class="profile-user-img img-responsive img-circle">
        <hr>
        <h3 class="profile-username text-center">Foto de Perfil</h3>
        <hr>
        {!! Form::file('image', ['onchange' => 'readURL(this)']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('role', 'Rol:') !!}
        {!! Form::select('role_id', $roles, null, ['class' => 'form-control']); !!}
    </div>

    <div class="form-group">
        {!! Form::label('client_id', 'Cliente:') !!}
        {!! Form::select('client_id', $clients, null, ['class' => 'form-control']); !!}
    </div>

</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('users.index') !!}" class="btn btn-default">Cancelar</a>
</div>
