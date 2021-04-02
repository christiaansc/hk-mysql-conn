@extends('layouts.dashboard')
@section('title','Gestión de Gastos')

@section('breadcrumb')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Administracion de gastos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>      
              <li class="breadcrumb-item active">gastos</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
@endsection
@section('content')

<div class="container-fluid">
<div class="card">
			<div class="card-header">
				<a href="{{route('insumos.create')}}">
					<span class="btn btn-success">+ Crear nuevo gasto</span>
				</a>
			</div>
            <!-- /.card-header -->
            <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"  style="width:100%">
                <thead>
                <tr>
                  <th>Detalle</th>
                
                  <th>Monto </th>
                  <th>Cantidad</th>
                  <th>Monto total</th>

                  <th>fecha gasto</th>
                  <th>Estado</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($gastos as $gasto)
                                <tr>
                                    <th scope="row">{{$gasto->nombre}}</th>
                            
                                    
                                    <td> $ {{number_format($gasto->monto)}}</td>
                                    <td>{{$gasto->cantidad}}</td>
                                    <td> $ {{number_format($gasto->montoTotal)}}</td>
                                    
                                    <td>
							{{\Carbon\Carbon::parse($gasto->fechaGasto)->format('d M y h:i')}}

							</td>
                                    @if ($gasto->estado == 'PAGADO')
                                    <td>
                                        <a class="button btn btn-success btn-sm" href="{{route('change.status.insumos', $gasto)}}" title="Editar">
                                            PAGADO <i class="fas fa-check"></i>
                                        </a>
                                    </td>
                                    @else
                                    <td>
                                        <a class="button btn btn-warning btn-sm" href="{{route('change.status.insumos', $gasto)}}" title="Editar">
                                            PENDIENTE <i class="fas fa-times"></i>
                                        </a>
                                    </td>
                                    @endif
                                                                       
                                    <td >
                                      
                                      {!! Form::open(['route'=>['gastos.destroy',$gasto], 'method'=>'DELETE']) !!}
                                        <a class="btn  btn-info btn-sm" data-toggle="modal" data-target="#modal-default" data-id="{{ $gasto->id }} title="Editar">
                                           
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        
                                        <button class="btn  btn-danger btn-sm" id="eliminar" type="submit" title="Eliminar">
                                           
                                            <i class="fas fa-trash-alt"></i>
                                        </button>

                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                              </tbody>
                              <tfoot>
                                <tr>
              
                                  <th>detalle</th>
                                  <th>monto</th>
                                  <th>Cantidad</th>
                                <th>Monto total</th>
                                  
                                <th>fecha gasto</th>
                                  <th>Estado</th>
                                  <th>Acciones</th>
                                </tr>
                              </tfoot>
                            </table>
                          </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  
  <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-body">
              <form  action="{{route('editGasto')}}" method="POST">
                @csrf
                {{method_field('patch')}}
                <div class="form-group">
                    <input type="hidden" class="form-control" name="id" id="id" value="{{$gasto->id}}">
                      <label for="estado">Estado pago</label>
                      <select class="form-control" name="estado" id="estado">                    
                        <option value="PAGADO">PAGADO</option>
                        <option value="PENDIENTE">PENDIENTE</option>                      
                      </select>
                    </div>
             
              </div>
              <div class="modal-footer justify-content-between">
                <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Modificar</button>
              </div>
            </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        @endforeach 
@endsection
        

@section('script')

<script>
  $(function () {
    $('#example1').DataTable({
      "paging": true,
      "lengthChange": true,
      "responsive": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autsoWidth": true,
    });
  });
</script>
@endsection