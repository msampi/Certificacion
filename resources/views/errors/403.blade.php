<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <meta name="MobileOptimized" content="320">
    <link type="image/x-icon" href="favicon.png" rel="shortcut icon"/>

    <title>{{ Config::get('cdigital.page_title') }} | Unauthorized action</title>

    {!! Html::style('thirdparties/css/bootstrap/bootstrap.min.css') !!}
    {!! Html::style('thirdparties/css/libs/font-awesome.css') !!}
    {!! Html::style('thirdparties/css/libs/nanoscroller.css') !!}
    {!! Html::style('thirdparties/css/compiled/theme_styles.css') !!}

</head>
<body id="error-page">
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div id="error-box">
                <div class="row">
                    <div class="col-xs-12">
                        <div id="error-box-inner">
                            <img src="{{URL::asset('thirdparties/img/error-404-v3.png')}}" alt="Usted puede ver esta p&aacute;gina?"/>
                        </div>
                        <h1>ERROR 403</h1>

                        <p>
                            Acci&oacute;n no autorizada..<br/>
                        </p>

                        <p>
                            Regrese al <a href="{{URL::route('dashboard')}}">inicio</a>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--[if lt IE 9]>
{!! Html::script('thirdparties/js/html5shiv.js') !!}
{!! Html::script('thirdparties/js/respond.min.js') !!}
<![endif]-->

{!! Html::script('thirdparties/js/jquery.js') !!}
{!! Html::script('thirdparties/js/bootstrap.js') !!}
{!! Html::script('thirdparties/js/jquery.nanoscroller.min.js') !!}
{!! Html::script('thirdparties/js/scripts.js') !!}

</body>
</html>