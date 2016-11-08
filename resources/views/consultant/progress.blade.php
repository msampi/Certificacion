@extends('layouts.consultant')

@section('content')


    <div class="col-md-12">
      <h2>{!! $evaluationUser[0]->evaluation->name !!}</h2>
    </div>
    <div class="col-md-12">
       <div class="box box-solid">
            <div class="box-header with-border">
              <i class="fa fa-users"></i>

              <h3 class="box-title">Participantes en: <strong>{!! $exercise->name !!}</strong></h3><br>
              <a href="{!! url('/uploads/'.$exercise->consultant_pdf) !!}" target="_BLANK">{!! $exercise->consultant_pdf !!}</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-hover dataTable">
                  <thead>
                    <th>Nombre Participante</th>
                    <th>Email</th>
                    <th width="50px">Estado</th>
                    <th width="50px">Acción</th>
                  </thead>
                  @foreach ($evaluationUser as $ev)
                    <tr>
                        <td>{!! $ev->competitor->name !!} {!! $ev->competitor->last_name !!}</td>
                        <td>{!! $ev->competitor->email !!}</td>
                        <td class="text-center"><span class="label bg-red">NO INICIADO</span></td>
                        <td class="text-center"><a href="{!! url('consultant/follow/'.$exercise->id.'/'.$ev->competitor->id) !!}" class="label bg-green">HACER SEGUIMIENTO</a></td>
                    </tr>
                  
                  @endforeach
                  
              </table>
                
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
    </div>

@endsection
