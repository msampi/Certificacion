<section class="content-header">
      <div class="user-panel">
        <div class="pull-left image">
          <img alt="User Image" class="img-circle" src="{{ URL::asset('uploads/'.$user->image) }}">
        </div>
        <div class="pull-left info">
          <p>{!! $user->name !!} {!! $user->last_name !!}</p>
          <div>Area:</div>
          <div>Job Position:</div>
        </div>
        <div class="pull-right" id="saving-label">
          {!! $dictionary->translate('Guardando...') !!}
        </div>
      </div>

      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">{!! $dictionary->translate($section_name) !!}</li>
      </ol>
</section>
<section class="content-sub">
<div class="col-md-4">
      <h3 class="header-h3">{!! $dictionary->translate($section_name) !!}  : {!! $dictionary->translate('Etapa') !!} {!! $current_stage !!}</h3>
</div>
@if (!$is_logged_user)
<div class="col-md-8">
    <ul>
        <li><a href="{!! url( 'objectives/'.$user->id ) !!}"><i class="fa fa-check-square-o"></i>{!! $dictionary->translate('Objetivos') !!}</a></li>
        <li><a href="{!! url( 'competitions/'.$user->id ) !!}"><i class="fa fa-suitcase"></i>{!! $dictionary->translate('Competencias') !!}</a></li>
        <li><a href="{!! url( 'valorations/'.$user->id ) !!}"><i class="fa fa-check"></i>{!! $dictionary->translate('valores') !!}</a></li>
        <li><a href="{!! url( 'pdp/'.$user->id ) !!}"><i class="fa fa-list"></i>PDP</a></li>
        <li><a href="{!! url( 'performances/'.$user->id ) !!}"><i class="fa fa-bar-chart"></i> <span>{!! $dictionary->translate('Valoración Global') !!}</span></a></li>

    </ul>
</div>
@endif
</section>
