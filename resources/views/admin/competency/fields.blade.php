<!-- Name Field -->
<input type="hidden" name="evaluation_id" value="{!! $evaluation_id !!}">
<div class="form-group col-sm-7 multilang-group">
    {!! Form::label('name', $dictionary->translate('Nombre').':') !!}
    @foreach ($languages as $language)
      
      {!! Form::text('name['.$language->id.']', null, ['class' => 'form-control multilang', 'data-lang' => $language->name]) !!}

    @endforeach
</div>
<div class="col-md-2">
        {!! Form::label('new_post', $dictionary->translate('Nuevo Puesto').':') !!}
        {!! Form::text('new_post', null , ['class' => 'form-control new-post']) !!}
</div> 
<div class="form-group col-sm-2">
    {!! Form::label('post', $dictionary->translate('Puesto').':') !!}
    {!! Form::select('post_id', $posts, null, ['class' => 'form-control post-list']) !!}
</div>
<div class="form-group col-sm-1">
    {!! Form::label('weight', $dictionary->translate('Peso').':') !!}
    {!! Form::text('weight', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-12 multilang-group">
    {!! Form::label('description', $dictionary->translate('Descripción').':') !!}
    @foreach ($languages as $language)
      <div class="multilang" data-lang="{!! $language->name !!}">
       {!! Form::textarea('description['.$language->id.']', null, ['class' => 'form-control textarea']) !!}
      </div>
    @endforeach
</div>

<!-- Submit Field -->
<input type="hidden" name="remove-item-list" id="remove-item-list">

<div class="form-group col-sm-12">
	<a role="button" class="btn btn-success behaviour-list-button"><span class="glyphicon glyphicon-plus"></span> &nbsp;Agregar Comportamiento</a>
</div>
<div class="form-group col-sm-12">
	<div class="panel panel-default behaviour-list">
  		<div class="panel-heading">
    		<h3 class="panel-title"><i class="fa fa-th"></i> <strong>{!! $dictionary->translate('Comportamientos') !!}</strong></h3><em>{!! $dictionary->translate('Agregue aqui los comportamientos de esta competencia') !!}</em>
  		</div>
  		<div class="panel-body">
  			<div class="row">
	  			<div class="col-md-10">
	  				<label>{!! $dictionary->translate('Comportamiento') !!}</label>
	  			</div>
	  			<div class="col-md-2">
	  				<label>{!! $dictionary->translate('Acción') !!}</label>
	  			</div>
  			</div>
            @if (empty($competition->behaviours) || $competition->behaviours->isEmpty())
            	<div class="callout callout-info">
                 	<p>{!! $dictionary->translate('Esta competencia no tiene comportamientos') !!}</p>
            	</div>
            @else
              
	            @foreach ($competition->behaviours as $behaviour)
	            <div class="row">
	            	<div class="col-md-10 multilang-group">
                  @foreach ($languages as $language)
      
                    
                    <textarea class="form-control multilang" data-lang="{{ $language->name }}" name="behaviours[{{ $behaviour->id }}][{{ $language->id }}]" >{!! $behaviour->description[$language->id] or '' !!}</textarea>
                  @endforeach
	                    
	                </div>
	                <div class="col-md-2">
	                    <a class="btn btn-danger" onclick="removeManyListItem(this); addItemToRemove({!! $behaviour->id !!})"><i class="glyphicon glyphicon-trash"></i> Eliminar</a>
	                </div>
	            </div>
	            @endforeach
	        @endif
            
  		</div>
	</div>
</div>
<div class="form-group col-sm-12">
    {!! Form::submit($dictionary->translate('Guardar'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.competitions.index','search='.$evaluation_id) !!}" class="btn btn-default">{!! $dictionary->translate('Cancelar') !!}</a>
</div>

