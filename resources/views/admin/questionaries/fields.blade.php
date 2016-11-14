
<!-- Name Field -->
<input type="hidden" name="remove-item-list" id="remove-item-list">
<input type="hidden" name="remove-option-list" id="remove-option-list">
<div class="form-group col-sm-12">
    {!! Form::label('name', 'Nombre:') !!} 
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Type Field -->
<!--<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('type', 'Tipo de cuestionario:') !!}
    {!! Form::select('type',  $types, null,  ['class' => 'form-control']) !!}
</div>-->
<div class="form-group col-sm-12">
	<a role="button" class="btn btn-success item-list-button" data-type="questionary"><span class="glyphicon glyphicon-plus"></span> &nbsp;Agregar Pregunta</a>
</div>
<div class="form-group col-sm-12">
	<div class="panel panel-default item-list">
  		<div class="panel-heading">
    		<h3 class="panel-title"><i class="fa fa-th"></i> <strong>Preguntas</strong></h3><em>Puede crear un cuestionario de preguntas con respuestas o custionario de tipo multiple-chice. Para las preguntas que no tengan opciones se obligara un ingreso de texto como respuesta.</em>
  		</div>
  		<div class="panel-body">
  			
            @if (empty($questionary->questions) || $questionary->questions->isEmpty())
            	<div class="callout callout-info">
                 	<p>Sin datos</p>
            	</div>
            @else
	            @foreach ($questionary->questions as $question)
	            <div class="row"> 
                    <div class="col-md-8">
                        <label>Pregunta</label>
                        <input type="text" name="question[{!! $question->id !!}][question]" class="form-control" value="{!! $question->question !!}">
                    </div>
                    <div class="col-md-2"><label style="display:block">&nbsp;</label><a class="btn btn-primary btn-full" onclick="addSubItem(this,{!! $question->id !!})">Agregar opción</a></div>
	                <div class="col-md-2">
                        <label style="display:block">&nbsp;</label>
	                    <a class="btn btn-danger btn-full" onclick="removeManyListItem(this); addItemToRemove({!! $question->id !!})"><i class="glyphicon glyphicon-trash"></i> Eliminar</a>
	                </div>
                    @foreach ($question->options as $option)
                           <div class="row">
                                <div class="col-md-8 col-md-offset-1">
                                    <label>Opción</label>
                                    <input type="text" name="question[{!! $question->id !!}][option][{!! $option->id !!}]" class="form-control" value="{!! $option->option !!}">
                                </div>
                                <div class="col-md-2"><label style="display:block">&nbsp;</label>
                                    <a class="btn btn-danger btn-full" onclick="removeManyListItem(this);addOptionToRemove({!! $option->id !!})"><i class="glyphicon glyphicon-trash"></i> Eliminar</a>
                                </div>
                            </div>

                        @endforeach
	            </div>
	            @endforeach
            
	        @endif
            
  		</div>
	</div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('questionaries.index') !!}" class="btn btn-default">Cancelar</a>
</div>
