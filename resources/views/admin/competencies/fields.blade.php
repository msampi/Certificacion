<!-- Name Field -->

<div class="form-group col-sm-8">
    {!! Form::label('name', 'Nombre:') !!}    
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
<div class="col-md-4">
    {!! Form::label('clients', 'Cliente:') !!}
    {!! Form::select('client_id',  $clients, null,  ['class' => 'form-control', 'id' => 'client-competency-selector']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('name', 'Nuevo Grupo:') !!}    
    {!! Form::text('new_group', null, ['class' => 'form-control new-group']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('competency_group_id', 'Grupo:') !!}    
    {!! Form::select('competency_group_id',  $competency_groups, null,  ['class' => 'form-control group-list', 'id' => 'competency-group-selector']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::label('description', 'Descripción:') !!}  
    {!! Form::textarea('description', null, ['class' => 'form-control textarea']) !!}
</div>

<!-- Submit Field -->
<input type="hidden" name="remove-item-list" id="remove-item-list">

<div class="form-group col-sm-12">
	<a role="button" class="btn btn-success item-list-button" data-type="competency"><span class="glyphicon glyphicon-plus"></span> &nbsp;Agregar Indicador</a>
</div>
<div class="form-group col-sm-12">
	<div class="panel panel-default item-list">
  		<div class="panel-heading">
    		<h3 class="panel-title"><i class="fa fa-th"></i> <strong>Indicadores</strong></h3><em>Agregue aqui los indicadores de esta competencia</em>
  		</div>
  		<div class="panel-body">
  			
            @if (empty($competency->items) || $competency->items->isEmpty())
            	<div class="callout callout-info">
                 	<p>Sin datos</p>
            	</div>
            @else
              
	            @foreach ($competency->items as $item)
	            <div class="row"> 
                    <div class="col-md-5">
                        <label>Indicador Positivo</label>
                        <textarea name="items[{!! $item->id !!}][positivo]" class="form-control">{!! $item->positive !!}</textarea>
                    </div>
                    <div class="col-md-5">
                        <label>Indicador Negativo</label>
                        <textarea name="items[{!! $item->id !!}][negativo]" class="form-control">{!! $item->negative !!}</textarea>
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
    <a href="{!! route('competencies.index') !!}" class="btn btn-default">Cancelar</a>
</div>
<script type="text/javascript">
    
    $(function(){
        searchCompetencyGroups();
    })
</script>
