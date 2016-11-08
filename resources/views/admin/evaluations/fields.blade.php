<input type="hidden" name="remove-item-list" id="remove-item-list">
<div class="col-sm-8">
<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', 'Nombre:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-12 ">
        {!! Form::label('client', 'Cliente:') !!}
        {!! Form::select('client_id',  $clients, null,  ['class' => 'form-control']) !!}
    </div>

<!-- Instructions Field -->
<div class="form-group col-sm-12 ">
    {!! Form::label('instructions', 'Instrucciones:') !!}
    {!! Form::textarea('instructions', null, ['class' => 'form-control textarea']) !!}
</div>
<div class="col-md-8">
    {!! Form::label('exercises', 'Ejercicios:') !!}
    {!! Form::select('exercises',  $exercises, null,  ['class' => 'form-control', 'id' => 'exercise-list-select']) !!}
</div>
<div class="col-md-4">
     {!! Form::label('null', '&nbsp;') !!}
     {!! Form::button('Agregar', ['class' => 'btn btn-primary btn-full', 'id' => 'exercise-list-button']) !!}
</div>
<div class="col-md-12">
    
    <ul id="exercise-list" class="todo-list">
        @if (isset($evaluation))
        @foreach($evaluation->exercises as $key => $exercise)
            <li>
              <div class="alert alert-success alert-dismissible handle">
                <input type="hidden" name="exercise[{!! $key !!}][id]" value="{!! $exercise->id !!}">
                <input type="hidden" name="exercise[{!! $key !!}][exercise_id]" value="{!! $exercise->exercise->id !!}">
                <button type="button" class="close" onclick="addItemToRemove({!! $exercise->id !!})" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> {!! $exercise->exercise->name !!}</h4>
                <div class="col-md-6">
                    <strong>Desde: </strong>
                    <input class="exercise-input datemask" type="text" name="exercise[{!! $key !!}][from]" value="{!! $exercise->date_from->format('d/m/Y')!!}" >
                    <strong> a las: </strong><input class="exercise-input-hour hourmask" name="exercise[{!! $key !!}][from_hour]" type="text" value="{!! $exercise->date_from->format('H:i')!!}">
                    <strong> hs </strong>
                </div>
                <div class="col-md-6 pull-right">
                    <strong>Hasta: </strong>
                    <input class="exercise-input datemask" value="{!! $exercise->date_to->format('d/m/Y')!!}" type="text" name="exercise[{!! $key !!}][to]">
                    <strong> a las: </strong><input class="exercise-input-hour hourmask" value="{!! $exercise->date_to->format('H:i')!!}"  name="exercise[{!! $key !!}][to_hour]"  type="text">
                    <strong> hs </strong>
                </div>
            </div>
        </li>
        
        @endforeach
        @endif
        
    </ul>
   
</div>

</div>
<div class="col-sm-4">
    <div class="box-body box-profile">
        <img id="image"  alt="User profile picture" src="{!! asset('img/excel.png') !!} " class="profile-user-img img-responsive img-circle">
        <hr>
        <h3 class="profile-username text-center">Importar Excel</h3>
        <hr>
        <h4>Excel Usuarios</h4>
        {!! Form::file('users_excel') !!}
        <h4>Excel Evaluación</h4>
        {!! Form::file('evaluation_excel') !!}
        
    </div>
    <div class="col-md-12">
        {!! Form::label('rating', 'Rating:') !!}
        {!! Form::select('rating_id',  $ratings, null,  ['class' => 'form-control']) !!}
    </div>
    <div class="col-md-12">
        <h3>Mensajes</h3>
    </div>
    <div class="col-md-12">
        {!! Form::label('registro', 'Mensaje de Registro:') !!}
        {!! Form::select('register_message_id',  $messages, null,  ['class' => 'form-control']) !!}
    </div>
    <div class="col-md-12">
        {!! Form::label('bienvenida', 'Mensaje de bienvenida:') !!}
        {!! Form::select('welcome_message_id',  $messages, null,  ['class' => 'form-control']) !!}
    </div>
    <div class="col-md-12">
        {!! Form::label('recuperacion', 'Recuperación de clave:') !!}
        {!! Form::select('recovery_message_id',  $messages, null,  ['class' => 'form-control']) !!}
    </div>
    

</div>



<!-- Submit Field -->
<div class="col-sm-12" style="margin-top:20px">
    <div class="col-md-12">
      <label style="font-size:16px">Lanzar evaluación</label>
      {!! Form::checkbox('start',false); !!}    
    </div>
     <div class="col-md-12">
        {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('evaluations.index') !!}" class="btn btn-default">Cancelar</a>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        


    })

</script>
