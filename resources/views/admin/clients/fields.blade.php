<div class="col-md-8">	
	<!-- Name Field -->
	<div class="form-group col-sm-12">
	    {!! Form::label('name', trans('labels.Name:')) !!} 
	    {!! Form::text('name', null, ['class' => 'form-control']) !!}
	</div>
	
	<!-- Description Field -->
	<div class="form-group col-sm-12 col-lg-12">
	    {!! Form::label('description', trans('labels.Description:')) !!}
	    {!! Form::textarea('description', null, ['class' => 'form-control textarea']) !!}
	</div>

	<!-- Submit Field -->
	<div class="form-group col-sm-12">
	    {!! Form::submit(trans('labels.Save'), ['class' => 'btn btn-primary']) !!}
	    <a href="{!! route('clients.index') !!}" class="btn btn-default">@lang('labels.Cancel')</a>
	</div>
</div>
<div class="col-sm-4">
    <div class="box-body box-profile">
        <img id="image" alt="User profile picture" src="@if (isset($client)) @if ($client->logo)  {!! asset('uploads/'.$client->logo) !!} @else {!! asset('img/client.png') !!} @endif @else {!! asset('img/client.png') !!} @endif " class="profile-user-img img-responsive img-circle">
        <hr>
        <h3 class="profile-username text-center">Client Logo</h3>
        <hr>
        {!! Form::file('logo', ['onchange' => 'readURL(this)']) !!}
    </div>
    

</div>