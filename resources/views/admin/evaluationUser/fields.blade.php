<div class="col-sm-12  form-group">
    <input type="hidden" name="evaluation_id" value="{!! $evaluation->id !!}">
    <div class="col-md-6">
        {!! Form::label('user', $dictionary->translate('Usuario').':') !!}
        {!! Form::select('user_id',  $users, null,  ['class' => 'form-control select2']) !!}
    </div>
    <div class="col-md-6">
        {!! Form::label('evaluator', $dictionary->translate('Evaluador').':') !!}
        {!! Form::select('evaluator_id',  $users, null,  ['class' => 'form-control select2']) !!}
    </div>
</div>
<div class="col-sm-12 form-group">
    <div class="col-md-4">
        {!! Form::label('new_post', $dictionary->translate('Nuevo Puesto').':') !!}
        {!! Form::text('new_post', null , ['class' => 'form-control new-post']) !!}
    </div> 
    <div class="col-md-4">
        {!! Form::label('post', $dictionary->translate('Puesto Usuario').':') !!}
        {!! Form::select('post_id',  $posts, null,  ['class' => 'form-control post-list']) !!}
    </div>
   
    <div class="col-md-4">
        {!! Form::label('category', $dictionary->translate('Categoria Usuario').':') !!}
        {!! Form::text('category', null , ['class' => 'form-control']) !!}
    </div>
</div>


<!-- Submit Field -->
<div class="col-sm-12" style="margin-top:20px">
     <div class="col-md-12">
    {!! Form::submit($dictionary->translate('Guardar'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.evaluationUserEvaluators.index', 'search='.$evaluation->id) !!}" class="btn btn-default">{!! $dictionary->translate('Cancelar')!!}</a>
    </div>
</div>

