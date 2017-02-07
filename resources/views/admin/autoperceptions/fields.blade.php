<!-- Name Field -->

<div class="form-group col-sm-6">
    {!! Form::label('name', 'Nombre:') !!}    
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
<div class="col-md-3">
    {!! Form::label('clients', 'Cliente:') !!}
    {!! Form::select('client_id',  $clients, null,  ['class' => 'form-control']) !!}
</div>
<div class="col-md-3">
    {!! Form::label('rating', 'Rating:') !!}
    {!! Form::select('rating_id',  $ratings, null,  ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-12">
    {!! Form::label('instructions', 'Instrucciones de rating:') !!}    
    {!! Form::textarea('instructions', null, ['class' => 'form-control textarea']) !!}
</div>

<!-- Submit Field -->
<input type="hidden" name="remove-item-list" id="remove-item-list">

<div class="form-group col-sm-12">
	<a role="button" class="btn btn-success item-list-button" data-type="autoperception"><span class="glyphicon glyphicon-plus"></span> &nbsp;Agregar Item</a>
</div>
<div class="form-group col-sm-12">
	<div class="panel panel-default item-list">
  		<div class="panel-heading">
    		<h3 class="panel-title"><i class="fa fa-th"></i> <strong>Indicadores</strong></h3><em>Agregue aqui los indicadores de este cuestionario</em>
  		</div>
  		<div class="panel-body">
  			
            @if (empty($autoperception->items) || $autoperception->items->isEmpty())
            	<div class="callout callout-info">
                 	<p>Sin datos</p>
            	</div>
            @else
              
	            @foreach ($autoperception->items as $item)
	            <div class="row"> 
                    <div class="col-md-10">
                        <label>Descripción</label>
                        <textarea name="items[{!! $item->id !!}]" class="form-control">{!! $item->description !!}</textarea>
                    </div>
	                <div class="col-md-2">
                        <label style="display:block">&nbsp;</label>
	                    <a class="btn btn-danger" onclick="removeManyListItem(this); addItemToRemove({!! $item->id !!})"><i class="glyphicon glyphicon-trash"></i> Eliminar</a>
	                </div>
	            </div>
	            @endforeach
            
	        @endif
            
  		</div>
	</div>
</div>
<div class="form-group col-sm-12">
    {!! Form::label('reference', 'Referencia:') !!}    
    {!! Form::textarea('reference', null, ['class' => 'form-control textarea']) !!}
</div>
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('autoperceptions.index') !!}" class="btn btn-default">Cancelar</a>
</div>

