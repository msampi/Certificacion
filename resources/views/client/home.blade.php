@extends('layouts.client')

@section('content')


    <div class="col-md-12">
      <h2>Seccion de Cliente</h2>
    </div>
     <div class="col-md-12">
       <div class="box box-solid">
            <div class="box-header with-border">
              <i class="fa fa-sticky-note-o"></i>

              <h3 class="box-title">Evaluaciones</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-hover dataTable">
                  <thead>
                    <th >Nombre</th>
                    <th width="5%">Acción</th>
                    
                  </thead>
                  @foreach ($evaluations as $evaluation)
                  
                  <tr>
                    <td>{!! $evaluation->name !!}</td>
                    
                    <td class="text-center">
                        <a href="{!! url('/client/competitors/'.$evaluation->id) !!}"><span class="label bg-green">VER</span></a>
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
