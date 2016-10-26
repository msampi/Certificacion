<!-- Name Field -->
<input type="hidden" name="remove-item-list" id="remove-item-list">
<div class="form-group col-sm-6">
    {!! Form::label('name', $dictionary->translate('Nombre').':') !!} 
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-12">
	<a role="button" class="btn btn-success many-list-button"><span class="glyphicon glyphicon-plus"></span> &nbsp;Agregar Valor</a>
</div>
<div class="form-group col-sm-12">
	<div class="panel panel-default many-list">
  		<div class="panel-heading">
    		<h3 class="panel-title"><i class="fa fa-th"></i> <strong>{!! $dictionary->translate('Valores') !!}</strong></h3>
  		</div>
  		<div class="panel-body">
  			<div class="row">
	  			<div class="col-md-10">
	  				<label>{!! $dictionary->translate('Valor') !!}</label>
	  			</div>
	  			<div class="col-md-2">
	  				<label>{!! $dictionary->translate('Acción') !!}</label>
	  			</div>
  			</div>
            @if (empty($rating->values) || $rating->values->isEmpty())
            	<div class="callout callout-info">
                 	<p>{!! $dictionary->translate('Este rating no tiene valores') !!}</p>
            	</div>
            @else
	            @foreach ($rating->values as $value)
	            <div class="row">
	            	<div class="col-md-10 multilang-group">
	            		@foreach ($languages as $language)
      
		                    <input type="text" class="form-control multilang" data-lang="{{ $language->name }}" name="values[{!! $value->id !!}][{!! $language->id !!}]" value="{{ $value->value[$language->id] or '' }}">
		                
		                @endforeach
	                    
	                </div>
	                <div class="col-md-2">
	                    <a class="btn btn-danger" onclick="removeManyListItem(this); addItemToRemove({!! $value->id !!})"><i class="glyphicon glyphicon-trash"></i> Eliminar</a>
	                </div>
	            </div>
	            @endforeach
	        @endif
            
  		</div>
	</div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit($dictionary->translate('Guardar'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.ratings.index') !!}" class="btn btn-default">{!! $dictionary->translate('Cancelar') !!}</a>
</div>

