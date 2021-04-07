@extends('layouts.dashboard')
@section('title','Gestión de Inventatio')

@section('breadcrumb')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Administracion de Inventario</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>      
              <li class="breadcrumb-item active">Insumos</li>
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
				<span class="btn btn-success">Crear nuevo Insumo</span>
			</a>
			<ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Insumos cocina</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">insumos local</a></li>
            </ul>
		</div>
	
		<!-- /.card-header -->
		<div class="card-body table-responsive">
			<div class="tab-content">

                <div class="active tab-pane" id="activity">
					<table id="example1" class="table table-bordered table-striped dataTable dtr-inline"  style="width:100%">
						<thead>
							<tr>
								<th>id</th>
								<th>Detalle</th>
								<th>Cantidad</th>
								<th>Tipo Insumo</th>
								<th>Estado</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($insumosCocina as $insumo)
								<tr>
									<th scope="row">{{$insumo->id}}</th>
									<th>{{$insumo->nombre}}</th>

								
									
									
									<td>{{$insumo->stock}}</td>
									<td>{{$insumo->tipo_insumo}}</td>

									
									@if ($insumo->estado == 'ACTIVO')
										<td>
											<a class="button btn btn-success btn-sm" href="{{route('change.status.insumos', $insumo)}}" title="Editar">
												Activo <i class="fas fa-check"></i>
											</a>
										</td>
										@else
										<td>
											<a class="button btn btn-danger btn-sm" href="{{route('change.status.insumos', $insumo)}}" title="Editar">
											Desactivado <i class="fas fa-times"></i>
											</a>
										</td>
									@endif                                
									<td >
										
										{!! Form::open(['route'=>['insumos.destroy',$insumo], 'method'=>'DELETE']) !!}

											<a class="btn  btn-info btn-sm" data-toggle="modal" data-target="#modal-default" data-id="{{ $insumo->id }} title="Editar">									
												<i class="fas fa-edit"></i>
											</a>									
											<button class="btn  btn-danger btn-sm" id="eliminar" type="submit" title="Eliminar">									
												<i class="fas fa-trash-alt"></i>
											</button>

										{!! Form::close() !!}
									</td>
								</tr>
							@endforeach 
						</tbody>
						<tfoot>
							<tr>
								<th>id</th>		
								<th>Detalle</th>		
								<th>Cantidad</th>
								<th>Tipo insumo</th>								
								<th>Estado</th>
								<th>Acciones</th>
							</tr>
						</tfoot>
					</table>				  
                </div>
                  <!-- /.tab-pane -->
                <div class="tab-pane" id="timeline">

					<table id="example2" class="table table-bordered table-striped dataTable dtr-inline"  style="width:100%">
						<thead>
							<tr>
								<th>id</th>
								<th>Detalle</th>
								<th>Cantidad</th>
								<th>Tipo insumo</th>
								<th>Estado</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($insumosLocal as $insumo)
								<tr>
									<th scope="row">{{$insumo->id}}</th>
									<th>{{$insumo->nombre}}</th>

								
									
									
									<td>{{$insumo->stock}}</td>
									<td>{{$insumo->tipo_insumo}}</td>

									
									@if ($insumo->estado == 'ACTIVO')
										<td>
											<a class="button btn btn-success btn-sm" href="{{route('change.status.insumos', $insumo)}}" title="Editar">
												Activo <i class="fas fa-check"></i>
											</a>
										</td>
										@else
										<td>
											<a class="button btn btn-danger btn-sm" href="{{route('change.status.insumos', $insumo)}}" title="Editar">
											Desactivado <i class="fas fa-times"></i>
											</a>
										</td>
									@endif                                
									<td >
										
										{!! Form::open(['route'=>['insumos.destroy',$insumo], 'method'=>'DELETE']) !!}

											<a class="btn  btn-info btn-sm" data-toggle="modal" data-target="#modal-default" data-id="{{ $insumo->id }} title="Editar">									
												<i class="fas fa-edit"></i>
											</a>									
											<button class="btn  btn-danger btn-sm" id="eliminar" type="submit" title="Eliminar">									
												<i class="fas fa-trash-alt"></i>
											</button>

										{!! Form::close() !!}
									</td>
								</tr>
							@endforeach 
						</tbody>
						<tfoot>
							<tr>
								<th>id</th>		
								<th>Detalle</th>		
								<th>Cantidad</th>
								<th>Tipo insumo</th>
								<th>Estado</th>
								<th>Acciones</th>
							</tr>
						</tfoot>
					</table>
                  <!-- /.tab-pane -->
            	</div>
			</div>
		<!-- /.card-body -->
		</div>

    	<!-- /.card -->
    </div>
    <!-- /.container -->
</div>
  
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<form  action="{{route('editInsumo')}}" method="POST">
					@csrf
					{{method_field('patch')}}
					<div class="form-group">
						<label for="tipo_insumo">Tipo insumo</label>
						<select class="form-control" name="tipo_insumo" id="tipo_insumo">                    
							<option value="LOCAL">LOCAL</option>
							<option value="COCINA">COCINA</option>                      
                      	</select>
					</div>
					<div class="form-group">
						<label for="cantidad">Stock</label>
						<input type="number" class="form-control" name="cantidad" id="cantidad" aria-describedby="helpId"  value="{{$insumo->stock}}"required>
						<input type="hidden" class="form-control" name="id" id="id" value="{{$insumo->id}}">
					</div>
					
					<div class="modal-footer justify-content-between">
						<button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-success">Modificar</button>
					</div>
				</form>
			</div>
		</div>
    	<!-- /.modal-content -->
    </div>
	<!-- /.modal-dialog -->
</div>
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
	  "order": [[ 0, 'desc' ]],
    });
	$('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "responsive": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autsoWidth": true,
	  "order": [[ 0, 'desc' ]],
    });
  });
</script>
@endsection