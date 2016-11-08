<div class="col-sm-12  form-group">
    <input type="hidden" name="evaluation_id" value="{!! $evaluation->id !!}">
    <div class="col-md-4">
        {!! Form::label('competitor', 'Participante:') !!}
        {!! Form::select('competitor_id',  $competitors, null,  ['class' => 'form-control select2']) !!}
    </div>
    <div class="col-md-4">
        {!! Form::label('primary_consultant', 'Consultor Primario:') !!}
        {!! Form::select('primary_consultant_id',  $consultants, null,  ['class' => 'form-control select2']) !!}
    </div>
    <div class="col-md-4">
        {!! Form::label('secondary_consultant', 'Consultor Secundario:') !!}
        {!! Form::select('secondary_consultant_id',  $consultants, null,  ['class' => 'form-control select2']) !!}
    </div>
</div>


<!-- Submit Field -->
<div class="col-sm-12" style="margin-top:20px">
     <div class="col-md-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('evaluationUser.index', 'search='.$evaluation->id) !!}" class="btn btn-default">Cancelar</a>
    </div>
</div>

