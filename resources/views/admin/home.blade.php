@extends('layouts.admin')

@section('content')
    <section class="content-header">
      <h1>
        <b>Assessment</b>
      </h1>
      <h4>
        Sistema de Certificaciones
      </h4>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

      </ol>
    </section>
    <section class="content">
        @include('flash::message')
        <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"> <i class="fa fa-file-excel-o"></i> Importación de datos</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                {!! Form::open(['url' => 'upload', 'files' => true]) !!}
                <div class="col-md-6">
                    
                    <p>Seleccione el cliente a quien se le asignarán los datos</p>
                    {!! Form::label('clients', 'Cliente:') !!}
                    {!! Form::select('client_id',  $clients, null,  ['class' => 'form-control']) !!}
                </div>
                <div class="col-md-12 mt20">
                    <p><strong>Desde aqui puede importar datos como competencias y cuestionarios en formato XLS/XLSX.</strong></p>
                    {!! Form::file('data_excel') !!}
                </div>
                <div class="col-md-12 mt20">
                    {!! Form::submit('Importar', ['class' => 'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}    
            
            </div>
            <!-- /.box-body -->
        </div>
        
        
    </section>

@endsection
