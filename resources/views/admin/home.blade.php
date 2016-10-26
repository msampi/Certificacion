@extends('layouts.admin')

@section('content')
    <section class="content-header">
      <h1>
        Sistema <b>SC</b>
      </h1>
      <h4>
        Sistema de Certificaciones
      </h4>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

      </ol>
    </section>
    <section class="content">
    <div class="row">
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{!! $userCount !!}</h3>

              <p>Usuarios</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{!! URL::asset( 'admin/users' ) !!}" class="small-box-footer">
              Ver <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <!--<div class="col-lg-4 col-xs-6">

          <div class="small-box bg-green">
            <div class="inner">
              <h3>{!! $clientCount !!}</h3>

              <p>Clientes</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-people"></i>
            </div>
            <a href="{!! URL::asset( 'admin/clients' ) !!}" class="small-box-footer">
              Ver <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>-->


      <!-- /.row -->
      </section>

@endsection
