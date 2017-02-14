
<!-- Name Field -->
<input type="hidden" name="remove-item-list" id="remove-item-list">
<input type="hidden" name="remove-question-list" id="remove-question-list">
<input type="hidden" name="remove-autoperception-list" id="remove-autoperception-list">
<div class="form-group col-sm-12">
    {!! Form::label('name', 'Nombre:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Tipo de ejercicio:') !!}
    {!! Form::select('exercise_type_id',  $exercise_types, null,  ['class' => 'form-control', 'id' => 'exercise_type_id']) !!}
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
    <h4><i class="ion ion-ios-paper"></i> Archivo de participantes cargado</h4>
</div>
@else
<div class="form-group col-sm-6">
    <h4><i class="ion ion-ios-paper"></i> No hay ningun archivo cargado</h4>
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
    <h4><i class="ion ion-ios-paper"></i> Archivo de consultores cargado</h4>
</div>
    
@else
<div class="form-group col-sm-6">
    
    <h4><i class="ion ion-ios-paper"></i> No hay ningun archivo cargado</h4>
    
</div>
@endif
<div class="clearfix"></div>
<div class="col-md-4">
    {!! Form::label('rating', 'Rating:') !!}
    {!! Form::select('rating_id',  $ratings, null,  ['class' => 'form-control']) !!}
</div>
<div class="col-md-8">
    <div class="col-md-8">
        {!! Form::label('competencies', 'Grupo de Competencias:') !!}
        {!! Form::select('competencies',  $competencies, null,  ['class' => 'form-control', 'id' => 'competency-list-select']) !!}
    </div>
    <div class="col-md-4">
         {!! Form::label('null', '&nbsp;') !!}
         {!! Form::button('Agregar', ['class' => 'btn btn-primary btn-full', 'id' => 'competency-list-button']) !!}
    </div>
</div>

<div class="col-md-12">
    
    <ul id="competency-list" class="todo-list">
    @if (isset($exercise))
        @foreach($exercise->competencyGroups as $key => $competency)
            <li>
              <div class="alert alert-success alert-dismissible handle">
                <input type="hidden" name="competency[{!! $key !!}][id]" value="{!! $competency->pivot->id !!}">
                <input type="hidden" name="competency[{!! $key !!}][competency_id]" value="{!! $competency->id !!}">
                <button type="button" class="close" onclick="addItemToRemove({!! $competency->pivot->id !!})" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> {!! $competency->name  !!}</h4>
                
            </div>
        </li>
        
        @endforeach
    @endif
       
    </ul>
   
</div>


<div id="autoperceptions">
    <div class="col-md-12">
        <h2>Cuestionario de Autopercepción</h2>
    </div>
    <div class="col-md-8">

            {!! Form::label('autoperceptions', 'Cuestionarios:') !!}
            {!! Form::select('autoperceptions',  $autoperceptions, null,  ['class' => 'form-control', 'id' => 'autoperception-list-select']) !!}
        </div>
        <div class="col-md-4">
             {!! Form::label('null', '&nbsp;') !!}
             {!! Form::button('Agregar', ['class' => 'btn btn-primary btn-full', 'id' => 'autoperception-list-button']) !!}
        </div>
    <div class="col-md-12">

        <ul id="autoperception-list" class="todo-list">
        @if (isset($exercise))
            @foreach($exercise->autoperceptions as $key => $autoperception)
                <li>
                  <div class="alert alert-info alert-dismissible handle">
                    <input type="hidden" name="autoperception[{!! $key !!}][id]" value="{!! $autoperception->pivot->id !!}">
                    <input type="hidden" name="autoperception[{!! $key !!}][autoperception_id]" value="{!! $autoperception->id !!}">
                    <button type="button" class="close" onclick="addAutoItemsToRemove({!! $autoperception->pivot->id !!})" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> {!! $autoperception->name  !!}</h4>

                </div>
            </li>

            @endforeach
        @endif

        </ul>

    </div>
</div>


<div id="knowledges">
    <div class="col-md-12">
        <h2>Cuestionario de Conocimientos</h2>
    </div>
    <div class="col-md-8">

            {!! Form::label('questionaries', 'Cuestionarios:') !!}
            {!! Form::select('questionaries',  $questionaries, null,  ['class' => 'form-control', 'id' => 'questionary-list-select']) !!}
        </div>
        <div class="col-md-4">
             {!! Form::label('null', '&nbsp;') !!}
             {!! Form::button('Agregar', ['class' => 'btn btn-primary btn-full', 'id' => 'questionary-list-button']) !!}
        </div>
    <div class="col-md-12">

        <ul id="questionary-list" class="todo-list">
        @if (isset($exercise))
            @foreach($exercise->questionaries as $key => $questionary)
                <li>
                  <div class="alert alert-warning alert-dismissible handle">
                    <input type="hidden" name="questionary[{!! $key !!}][id]" value="{!! $questionary->pivot->id !!}">
                    <input type="hidden" name="questionary[{!! $key !!}][questionary_id]" value="{!! $questionary->id !!}">
                    <button type="button" class="close" onclick="addQuestionToRemove({!! $questionary->pivot->id !!})" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> {!! $questionary->name  !!}</h4>

                </div>
            </li>

            @endforeach
        @endif

        </ul>

    </div>
</div>
<div id="external_link">
    <div class="col-md-12">
        <h2>Link externo</h2>
    </div>
    <div class="col-md-12">

            {!! Form::label('external_link', 'Link externo:') !!}
            {!! Form::text('external_link', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div id="ecases">
    <div class="col-md-12">
        <h2>E-cases</h2>
    </div>
    <div class="col-md-12">

            {!! Form::label('simulation_name', 'Nombre de simulacion en plataforma E-case:') !!}
            {!! Form::text('simulation_name', null, ['class' => 'form-control']) !!}
    </div>
</div>
        

<!-- Submit Field -->
<div class="form-group col-sm-12 mt20">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('exercises.index') !!}" class="btn btn-default">Cancelar</a>
</div>
<script type="text/javascript">
    
function hideAll()
{
     $('#autoperceptions').hide();
     $('#knowledges').hide();  
     $('#external_link').hide();
     $('#ecases').hide();
       
}
function showExerciseTypeSections()
{
    var selected = $('#exercise_type_id').val();
    hideAll();
    
    if (selected == 2) //Autopercepcion 
        $('#autoperceptions').show();
    if (selected == 3) //Conocimiento 
        $('#knowledges').show();
    if (selected == 6) //Conocimiento 
        $('#external_link').show();
    if (selected == 5) //Ecases 
        $('#ecases').show();
    
    
}

$(function(){
    showExerciseTypeSections();
    $('#exercise_type_id').change(function(){
        showExerciseTypeSections();
    })
})
</script>
