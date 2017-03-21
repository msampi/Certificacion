@extends('layouts.consultant')

@section('content')

    <div class="col-md-12">
      <h2>{!! $evaluationUser[0]->evaluation->name !!}</h2>
    </div>
    <div class="col-md-12">
       <div class="box box-solid">
            <div class="box-header with-border">
              <i class="fa fa-users"></i>

              <h3 class="box-title">Participantes en: <strong>{!! $exercise->name !!}</strong></h3>
              @if ($exercise->consultant_pdf != '')
              <br><br>
              Para ver el archivo adjunto del ejercicio <a href="{!! url('/uploads/'.$exercise->consultant_pdf) !!}" target="_BLANK">HAGA CLICK AQUI</a>
              @endif
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-hover dataTable">
                  <thead>
                    <th>Nombre Participante</th>
                    <th>Email</th>
                    <th width="130px">Estado participante</th>
                    <th width="50px">Acción</th>
                  </thead>
                  @foreach ($evaluationUser as $ev)
                    <tr>
                        <td>{!! $ev->competitor->name !!} {!! $ev->competitor->last_name !!}</td>
                        <td>{!! $ev->competitor->email !!}</td>
                        <td class="text-center">
                            @if ($evaluation_exercise->status_competitor == 0)
                            <span class="label bg-red">NO INICIADO</span>
                            @elseif ($evaluation_exercise->status_competitor == 1)
                            <span class="label bg-orange">INICIADO</span>
                            @else
                            <span class="label bg-green">FINALIZADO</span>
                            @endif
                        
                        </td>
                        
                        <td class="text-center"><a href="{!! url('consultant/'.$view.'/'.$exercise->id.'/'.$ev->competitor->id.'/'.Auth::user()->id) !!}" class="label bg-green">SEGUIMIENTO</a></td>
                    </tr>
                  
                  @endforeach
                  
              </table>
                
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
    </div>

@endsection
