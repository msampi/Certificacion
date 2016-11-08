<!-- Name Field -->
<input type="hidden" name="remove-item-list" id="remove-item-list">
<div class="form-group col-sm-12">
    {!! Form::label('name', 'Nombre:') !!} 
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-12">
	<a role="button" class="btn btn-success item-list-button" data-type="rating"><span class="glyphicon glyphicon-plus"></span> &nbsp;Agregar Valor</a>
</div>
<div class="form-group col-sm-12">
	<div class="panel panel-default item-list">
  		<div class="panel-heading">
    		<h3 class="panel-title"><i class="fa fa-th"></i> <strong>Valores</strong></h3>
  		</div>
  		<div class="panel-body">
  			
            @if (empty($rating->values) || $rating->values->isEmpty())
            	<div class="callout callout-info">
                 	<p>Sin datos</p>
            	</div>
            @else
	            @foreach ($rating->values as $value)
	            <div class="row">
	            	<div class="col-md-2">
                        <label>Valor</label>
		                  <input type="text" class="form-control" name="items[{!! $value->id !!}][value]" value="{{ $value->value }}">
	                </div>
                    <div class="col-md-8">
                         <label>Nombre</label>
		                  <input type="text" class="form-control" name="items[{!! $value->id !!}][name]" value="{{ $value->name }}">
	                </div>
	                <div class="col-md-2">
                        <label style="display:block">&nbsp;</label>
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
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('ratings.index') !!}" class="btn btn-default">Cancelar</a>
</div>

