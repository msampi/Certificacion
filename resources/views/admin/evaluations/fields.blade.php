<input type="hidden" name="remove-item-list" id="remove-item-list">
<div class="col-sm-8">
<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', $dictionary->translate('Nombre').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-12 ">
        {!! Form::label('client', $dictionary->translate('Cliente').':') !!}
        {!! Form::select('client_id',  $clients, null,  ['class' => 'form-control']) !!}
    </div>

<!-- Instructions Field -->
<div class="form-group col-sm-12 ">
    {!! Form::label('instructions', $dictionary->translate('Instrucciones').':') !!}
    {!! Form::textarea('instructions', null, ['class' => 'form-control textarea']) !!}
</div>

</div>
<div class="col-sm-4">
    <div class="box-body box-profile">
        <img id="image"  alt="User profile picture" src="{!! asset('img/excel.png') !!} " class="profile-user-img img-responsive img-circle">
        <hr>
        <h3 class="profile-username text-center">{!! $dictionary->translate('Importar Excel')!!}</h3>
        <hr>
        <h4>{!! $dictionary->translate('Excel Usuarios') !!}</h4>
        {!! Form::file('users_excel') !!}
        <h4>{!! $dictionary->translate('Excel Evaluación') !!}</h4>
        {!! Form::file('evaluation_excel') !!}
        <h4>{!! $dictionary->translate('Seleccione el idioma de importacion') !!}</h4>
        <div class="form-group">
            @foreach($languages as $key => $language)
            <label>{!! $language->name !!}</label>
            @if ($key == 0)
                {!! Form::radio('import_lang', $language->id, true); !!}
            @else
                {!! Form::radio('import_lang', $language->id, false); !!}
            @endif
            <br>
            @endforeach
        </div>
    </div>

</div>
<div class="col-md-12">
    <div class="col-md-4">
        <h3>{!! $dictionary->translate('Primera Etapa') !!}</h3>
        <em>(Objetivos)</em>
        <div class="form-group">
                <label>{!! $dictionary->translate('Duración') !!}:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  {!! Form::text('first_stage', null, ['class' => 'form-control pull-right active date-range']) !!}
                </div>
                <!-- /.input group -->
              </div>
    </div>
    <div class="col-md-4">
        <h3>{!! $dictionary->translate('Segunda Etapa') !!}</h3>
        <em>(Review Mitad de Año)</em>
        <div class="form-group">
                <label>{!! $dictionary->translate('Duración') !!}:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  {!! Form::text('second_stage', null, ['class' => 'form-control pull-right active date-range']) !!}
                </div>
                <!-- /.input group -->
              </div>
    </div>
    <div class="col-md-4">
        <h3>{!! $dictionary->translate('Tercera Etapa') !!}</h3>
        <em>(Review Fin de Año)</em>
        <div class="form-group">
                <label>{!! $dictionary->translate('Duración') !!}:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  {!! Form::text('third_stage', null, ['class' => 'form-control pull-right active date-range']) !!}
                </div>
                <!-- /.input group -->
              </div>
    </div>
</div>
<div class="col-md-12">
    <div class="col-md-5">
        <h4>{!! $dictionary->translate('Visualización para usuarios (Primera etapa)') !!}</h4>
        <em>(Promedios)</em>
        <div class="form-group">
                <label>{!! $dictionary->translate('Duración') !!}:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  {!! Form::text('vis_half_year', null, ['class' => 'form-control pull-right active date-range']) !!}
                </div>
                <!-- /.input group -->
              </div>
    </div>
    <div class="col-md-5">
        <h4>{!! $dictionary->translate('Visualización para usuarios (Segunda etapa)') !!}</h4>
        <em>(Promedios)</em>
        <div class="form-group">
                <label>{!! $dictionary->translate('Duración') !!}:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  {!! Form::text('vis_end_year', null, ['class' => 'form-control pull-right active date-range']) !!}
                </div>
                <!-- /.input group -->
              </div>
    </div>
    <div class="col-md-2">
        <div class="form-group" style="margin-top:50px; text-align:center">
              <label style="font-size:16px">{!! $dictionary->translate('Activar visualizaciones?') !!}</label>
              {!! Form::checkbox('visualization'); !!}
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="col-md-12">
        <h3>{!! $dictionary->translate('Ratings') !!}</h3>
    </div>
    <div class="col-md-4">
        {!! Form::label('rating', $dictionary->translate('Rating Objetivos').':') !!}
        {!! Form::select('objectives_rating_id',  $ratings, null,  ['class' => 'form-control']) !!}
    </div>
    <div class="col-md-4">
        {!! Form::label('rating', $dictionary->translate('Rating Competencias').':') !!}
        {!! Form::select('competitions_rating_id',  $ratings, null,  ['class' => 'form-control']) !!}
    </div>
    <div class="col-md-4">
        {!! Form::label('rating', $dictionary->translate('Rating Valores').':') !!}
        {!! Form::select('valorations_rating_id',  $ratings, null,  ['class' => 'form-control']) !!}
    </div>
</div>

<div class="col-md-12">
    <div class="col-md-12">
        <h3>{!! $dictionary->translate('Mensajes') !!}</h3>
    </div>
    <div class="col-md-4">
        {!! Form::label('registro', $dictionary->translate('Mensaje de Registro').':') !!}
        {!! Form::select('register_message_id',  $messages, null,  ['class' => 'form-control']) !!}
    </div>
    <div class="col-md-4">
        {!! Form::label('bienvenida', $dictionary->translate('Mensaje de bienvenida').':') !!}
        {!! Form::select('welcome_message_id',  $messages, null,  ['class' => 'form-control']) !!}
    </div>
    <div class="col-md-4">
        {!! Form::label('recuperacion', $dictionary->translate('Recuperación de clave').':') !!}
        {!! Form::select('recovery_message_id',  $messages, null,  ['class' => 'form-control']) !!}
    </div>
</div>

<div class="col-md-12">
    <div class="form-group col-sm-12">
        <h3><a role="button" class="btn btn-success documents-list-button"><span class="glyphicon glyphicon-plus"></span> &nbsp;Agregar Documento</a></h3>
    </div>
    <div class="form-group col-sm-12">
        <div class="panel panel-default documents-list">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-file-o"></i> <strong>{!! $dictionary->translate('Documentos') !!}</strong></h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-10">
                        <label>{!! $dictionary->translate('Nombre') !!}</label>
                    </div>
                    <div class="col-md-2">
                        <label>{!! $dictionary->translate('Acción') !!}</label>
                    </div>
                </div>
                @if (empty($evaluation->documents))
                    <div class="callout callout-info">
                        <p>{!! $dictionary->translate('Aun no hay documentos para esta evaluación') !!}</p>
                    </div>
                @else
                    @foreach ($evaluation->documents as $doc)
                    <div class="row">
                        <div class="col-md-10">
                            <input type="text" readonly value="{!! $doc->name!!}" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <a class="btn btn-danger" onclick="removeManyListItem(this); addItemToRemove({!! $doc->id !!})"><i class="glyphicon glyphicon-trash"></i> Eliminar</a>
                        </div>
                    </div>
                    @endforeach
                @endif

            </div>
        </div>
    </div>
</div>
<!-- Submit Field -->
<div class="col-sm-12" style="margin-top:20px">
    <div class="col-md-12">
      <label style="font-size:16px">{!! $dictionary->translate('Lanzar simulación') !!}</label>
      {!! Form::checkbox('start',false); !!}    
    </div>
     <div class="col-md-12">
        {!! Form::submit($dictionary->translate('Guardar'), ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('admin.evaluations.index') !!}" class="btn btn-default">{!! $dictionary->translate('Cancelar')!!}</a>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        moment.locale('{!! Auth::user()->language->prefix !!}');
        $('.date-range').daterangepicker({

            format: 'DD/MM/YYYY',
            locale: { cancelLabel: '<i class="fa fa-ban"></i>', applyLabel: '<i class="fa fa-check"></i>', fromLabel: '', toLabel: '' }

        });


    })

</script>
