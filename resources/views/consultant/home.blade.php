@extends('layouts.consultant')

@section('content')


    <div class="col-md-12">
      <h2>{!! $evaluationUser->evaluation->name !!}</h2>
    </div>
    <div class="col-md-12">
       <div class="box box-solid">
            <div class="box-header with-border">
              <i class="fa fa-sticky-note-o"></i>

              <h3 class="box-title">Ejercicios</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-hover dataTable">
                  <thead>
                    <th width="30%">Nombre</th>
                    <th>Fecha de Comienzo</th>
                    <th>Hora de Comienzo</th>
                    <th>Fecha de finalización</th>
                    <th>Hora de finalización</th>
                    <th width="15%">Acción</th>
                  </thead>
                  @foreach ($evaluationUser->evaluation->exercises as $exercise)
                  <tr>
                    <td>{!! $exercise->exercise->name !!}</td>
                    <td>{!! $exercise->date_from->format('d-m-Y') !!}</td>
                    <td>{!! $exercise->date_from->format('H:i:s') !!}</td>
                    <td>{!! $exercise->date_to->format('d-m-Y') !!}</td>
                    <td>{!! $exercise->date_to->format('H:i:s') !!}</td>
                    <td class="text-center">
                        @if ($is_primary_consultant)
                            @if ($exercise->status == 1)
                            <a href="{!! url('consultant/progress/'.$exercise->exercise_id) !!}" class="label bg-blue">CONTINUAR</a> 
                            <a href="{!! url('consultant/status/'.$exercise->exercise_id.'/2') !!}" class="label bg-red">FINALIZAR</a></td>
                            @else
                                @if ($exercise->status == 2)
                                    <a href="{!! url('consultant/status/'.$exercise->exercise_id.'/1') !!}" class="label bg-orange">REINICIAR</a></td>
                                @else
                                    <a href="{!! url('consultant/progress/'.$exercise->exercise_id) !!}" class="label bg-green btn-full">COMENZAR</a></td>
                                @endif
                            
                            @endif
                        @else
                        <a href="{!! url('consultant/progress/'.$exercise->exercise_id) !!}" class="label bg-green">VER</a></td>
                        @endif
                      
                  </tr>
            
                @endforeach
                  
              </table>
                
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
    </div>

@endsection
