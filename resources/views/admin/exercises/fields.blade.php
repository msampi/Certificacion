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
@if ($exercise->competitor_pdf)
<div class="form-group col-sm-6">
    <div class="alert alert-info fade in">
        <strong>{!! $exercise->competitor_pdf !!}</strong>
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
@if ($exercise->consultant_pdf)
<div class="form-group col-sm-6">
    <div class="alert alert-info fade in">
        <strong>{!! $exercise->consultant_pdf !!}</strong>
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

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('exercises.index') !!}" class="btn btn-default">Cancelar</a>
</div>
