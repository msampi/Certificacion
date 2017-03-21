@extends('layouts.client')

@section('content')


    <div class="col-md-12">
      <h2>Seccion de Cliente</h2>
    </div>
     <div class="col-md-12">
       <div class="box box-solid">
            <div class="box-header with-border">
              <i class="fa fa-sticky-note-o"></i>

              <h3 class="box-title">Participantes</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-hover dataTable">
                  <thead>
                    <th >Nombre</th>
                    <th >Email</th>
                    <th>Estado</th>
                    <th width="5%">Informe</th>
                    
                  </thead>
                  @foreach ($competitors as $competitor)
                  
                  <tr>
                    <td>{!! $competitor->name !!} {!! $competitor->last_name !!}</td>
                    <td>{!! $competitor->email !!} </td>
                    <td>{!! $competitor->competitorStatusLabel($competitor->pivot->status) !!} </td>               
                    <td class="text-center">
                        N/A
                    </td>     
                  </tr>
                  
                @endforeach
                  
              </table>
                
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
    </div>

@endsection
