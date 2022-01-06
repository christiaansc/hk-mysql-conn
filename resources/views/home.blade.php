@extends('layouts.dashboard')
@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">

    <!-- fitro periodo -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">              
                        <div class="form-group col-lg-2">
                            <label for="periodo">FILTRO PERIODO</label>
                            <select class="form-control" name="periodo" id="periodo">  
                                <option value="0" >PERIODO</option>
                                <option value="1">HOY</option>
                                <option value="2">AYER</option>
                                <option value="3">ESTE MES</option>


                            </select>
                        </div>                 
                        <button type="button" id="filtro" class="btn btn-success float-right">FILTRAR</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Montos ventas diarias  -->
    <div class="row">
        <div class="col-lg-3">
                <!-- small card -->
            @foreach($totalm as $mes)
            <div class="small-box bg-success">
                <div class="inner">
                    <h2>${{number_format($mes->totalmes)}}</h2>
                        <p>Ventas totales</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <a href="{{route('ventas.index')}}" class="small-box-footer">
                    Mas info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            @endforeach
            <div class="col-lg-3">
                <!-- small card -->
            @foreach($totalmesactual as $tmactual)
            <div class="small-box bg-warning">
                <div class="inner">
                    <h2>${{number_format($tmactual->totalmesactual)}}</h2>
                        <p>Venta total mes actual</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <a href="{{route('ventas.index')}}" class="small-box-footer">
                    Mas info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            @endforeach
            <div class="col-lg-3">
                <!-- small card -->
            @foreach($totalDiaAnt as $diaAnt)
            <div class="small-box bg-warning">
                <div class="inner">
                    <h2>${{number_format($diaAnt->totalAnt)}}</h2>
                        <p>Venta total Dia Anterior</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <a href="{{route('ventas.index')}}" class="small-box-footer">
                    Mas info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            @endforeach
            <div class="col-lg-3">
            @foreach($totaldia2 as $t_dia2)
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h2>${{number_format($t_dia2->totaldia)}}</h2>
                        <p>Venta total dia</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <a href="{{route('ventas.index')}}" class="small-box-footer">
                        Mas info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            @endforeach
    
    </div>

    <div class="row">
        <div class="col-lg-3">
                <!-- small card -->
            @foreach($t_credito as $credito)
            <div class="small-box bg-info">
                <div class="inner">
                    <h2 id="t_credito">${{number_format($credito->totalcredito)}}</h2>
                        <p>TOTAL VENTAS CREDITO</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-cash-register"></i>
                    </div>
                    <a href="{{route('ventas.index')}}" class="small-box-footer">
                    Mas info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            @endforeach
            <div class="col-lg-3">
                <!-- small card -->
            @foreach($t_debito as $debito)
            <div class="small-box bg-info">
                <div class="inner">
                    <h2 id="t_debito">${{number_format($debito->totaldebito)}}</h2>
                        <p>TOTAL VENTAS DEBITO</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-cash-register"></i>
                    </div>
                    <a href="{{route('ventas.index')}}" class="small-box-footer">
                    Mas info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            @endforeach
            <div class="col-lg-3">
                <!-- small card -->
            @foreach($t_transferencia as $transferencia)
            <div class="small-box bg-info">
                <div class="inner">
                    <h2 id="t_transfe">${{number_format($transferencia->totaltransferencia)}}</h2>
                        <p>TOTAL VENTAS TRANSFERENCIA</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-cash-register"></i>
                    </div>
                    <a href="{{route('ventas.index')}}" class="small-box-footer">
                    Mas info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            @endforeach
            <div class="col-lg-3">
            @foreach($t_efectivo as $efectivo)
                <div class="small-box bg-info">
                    <div class="inner">
                        <h2 id="t_efectivo">${{number_format($efectivo->totalefectivo)}}</h2>
                        <p>TOTAL VENTAS EFECTIVO</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-cash-register"></i>
                    </div>
                    <a href="{{route('ventas.index')}}" class="small-box-footer">
                        Mas info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            @endforeach
            <div class="col-lg-6">
            @foreach($totaldia2 as $t_dia2)

                <div class="small-box bg-secondary text-center">
                    <div class="inner">
                        <p><h5>META DIARIA</h5></p>
                        <h2>${{number_format($t_dia2->totaldia)}} / $120,000</h2>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                
                </div>
            @endforeach
            </div>
            <div class="col-lg-6">
                <div class="small-box bg-secondary text-center">
                    <div class="inner">
                        <p><h5>META MENSUAL</h5></p>
                        <h2>${{number_format($tmactual->totalmesactual)}} / $4,500,000</h2>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                
                </div>
            </div>
    </div>

    <!--  grafica ventas diarias y mensuales -->
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        <i class="fas fa-chart-line"></i>
                        Ventas - Meses
                    </h4>
                    <canvas id="ventas"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        <i class="fas fa-chart-line"></i>
                        Ventas - Dia
                    </h4>
                    <canvas id="ventas2"></canvas>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Prooductos vendidos de hoy  -->
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        <i class="fas fa-box"></i>
                        Productos  vendidos de hoy 
                    </h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th>Nombre</th>                                  
                                    <th>Cantidad vendida</th>
                                    <th>Ver detalles</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productos_vendidos_dia as $productosvendidohoy)
                                <tr>
                                    <td>{{$productosvendidohoy->id}}</td>
                                    <td>{{$productosvendidohoy->name}}</td>
                                    
                                    <td><strong>{{$productosvendidohoy->quantity}}</strong> Unidades</td>
                                    <td>
                                        <a class="btn btn-primary"
                                            href="{{route('products.show', $productosvendidohoy->id)}}">
                                            <i class="far fa-eye"></i>
                                            Ver detalles
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Productos mas vendidos del mes  -->
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        <i class="fas fa-box"></i>
                        Productos más vendidos ( Mes actual )
                    </h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th>Nombre</th>
                                    <th>Código</th>
                                    
                                    <th>Cantidad vendida</th>
                                    <th>Ver detalles</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productosvendidos as $productosvendido)
                                <tr>
                                    <td>{{$productosvendido->id}}</td>
                                    <td>{{$productosvendido->name}}</td>
                                    <td>{{$productosvendido->code}}</td>
                                    <td><strong>{{$productosvendido->quantity}}</strong> Unidades</td>
                                    <td>
                                        <a class="btn btn-primary"
                                            href="{{route('products.show', $productosvendido->id)}}">
                                            <i class="far fa-eye"></i>
                                            Ver detalles
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection
@section('script')
<script>

    

$(function () {
    $('#periodo').change(function(){
            var periodo = $('#periodo').val();
            $.ajax({
                url: "{{route('periodo')}}",
                method: 'GET',
                data:{
                    codPeriodo: periodo,
                },
                success: function(data){
                 
                    credito = data["t_credito"];
                    debito = data["t_debito"];
                    transf = data["t_transferencia"];
                    efectivo = data["t_efectivo"];

                    // console.log(data);
            
                    $("#t_efectivo").text(efectivo);
                    $("#t_transfe").text(transf);
                    $("#t_debito").text(debito);
                    $("#t_credito").text(credito);
                   


            }
        });
    });
});

</script>
<script>


    $(function () {
        var varVenta=document.getElementById('ventas2').getContext('2d');
            var charVenta = new Chart(varVenta, {
                type: 'line',
                data: {
                    labels: [<?php foreach ($ventasdia as $ventadia)
                {   
                    setlocale(LC_ALL, 'es_ES', 'Spanish_Spain', 'Spanish'); 

                
                    $dia = strftime('%A',strtotime($ventadia->dia)) ;
                    
                    echo '"'. $dia.'",';} ?>],
                    datasets: [{
                        label: 'Total ventas Diarias',
                        data: [<?php foreach ($ventasdia as $reg)
                        {echo ''. $reg->totalpordia.',';} ?>],
                        backgroundColor: 'rgba(255, 255, 255, 0)',
                        borderColor: 'rgba(0, 0, 0, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });

            var varVenta=document.getElementById('ventas').getContext('2d');
            var charVenta = new Chart(varVenta, {
                type: 'pie',
                data: {
                    labels: [<?php foreach ($ventasmes as $reg)
                {
                    setlocale(LC_ALL, 'es_ES', 'Spanish_Spain', 'Spanish'); 
                    
                    $mes_traducido=strftime('%B',strtotime($reg->mes));
                    
                    echo '"'. $reg->mes.'",';} ?>],
                    datasets: [{
                        label: 'Ventas',
                        data: [<?php foreach ($ventasmes as $reg)
                        {echo ''. $reg->totalmes.',';} ?>],
                        backgroundColor:  ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                        borderColor: 'rgba(0, 0, 0, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
           
    });
</script>
@endsection