<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', 'Nombre:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Tipo de ejercicio:') !!}
    {!! Form::select('exercise_type_id',  $exercise_types, null,  ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Cliente:') !!}
    {!! Form::select('client_id',  $clients, null,  ['class' => 'form-control']) !!}
</div>

<!-- Instructions Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('instructions', 'Instrucciones:') !!}
    {!! Form::textarea('instructions', null, ['class' => 'form-control textarea']) !!}
</div>

<!-- Competitor Pdf Field -->
<div class="form-group col-sm-6">
    {!! Form::label('competitor_pdf', 'PDF Participante:') !!}
    {!! Form::file('competitor_pdf') !!}
</div>
@if (isset($exercise) && $exercise->competitor_pdf)
<div class="form-group col-sm-6">
    <div class="alert alert-info fade in">
        <strong>Archivo cargado</strong>
    </div>
</div>
@else
<div class="form-group col-sm-6">
    <div class="alert alert-danger fade in">
        <strong>No hay ningun archivo cargado.</strong>
    </div>
</div>
@endif
<div class="clearfix"></div>

<!-- Consultant Pdf Field -->
<div class="form-group col-sm-6">
    {!! Form::label('consultant_pdf', 'PDF Consultor:') !!}
    {!! Form::file('consultant_pdf') !!}
</div>
@if (isset($exercise) && $exercise->consultant_pdf)
<div class="form-group col-sm-6">
    <div class="alert alert-info fade in">
        <strong>Archivo cargado</strong>
    </div>
    
</div>
@else
<div class="form-group col-sm-6">
    <div class="alert alert-danger fade in">
        <strong>No hay ningun archivo cargado.</strong>
    </div>
</div>
@endif
<div class="clearfix"></div>
<div class="col-md-8">
    {!! Form::label('competencies', 'Competencias:') !!}
    {!! Form::select('competencies',  $competencies, null,  ['class' => 'form-control', 'id' => 'competency-list-select']) !!}
</div>
<div class="col-md-4">
     {!! Form::label('null', '&nbsp;') !!}
     {!! Form::button('Agregar', ['class' => 'btn btn-primary btn-full', 'id' => 'competency-list-button']) !!}
</div>
<div class="col-md-12">
    
    <ul id="competency-list" class="todo-list">
    @if (isset($exercise))
        @foreach($exercise->competencies as $key => $competency)
            <li>
              <div class="alert alert-success alert-dismissible handle">
                <input type="hidden" name="competency[{!! $key !!}][id]" value="{!! $competency->id !!}">
                <input type="hidden" name="competency[{!! $key !!}][exercise_id]" value="{!! $exercise->exercise->id !!}">
                <button type="button" class="close" onclick="addItemToRemove({!! $competency->id !!})" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> {!! $competency->competency->name !!}</h4>
            </div>
        </li>
        
        @endforeach
    @endif
       
    </ul>
   
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('exercises.index') !!}" class="btn btn-default">Cancelar</a>
</div>
