@extends('layouts.dashboard')
@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
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
            <div class="small-box bg-danger">
                <div class="inner">
                    <h2>${{number_format($totaldia)}}</h2>
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
        <div class="col-lg-6">
            <div class="info-box bg-gradient-secondary">
                <span class="info-box-icon"><i class="far fa-bookmark"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"><strong>Meta diaria</strong></span>
                    <span class="info-box-number">${{number_format($totaldia)}} / $ 60.000</span>
    
                <!-- /.info-box-content -->
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="info-box bg-gradient-secondary">
                <span class="info-box-icon"><i class="far fa-bookmark"></i></span>
        @foreach($totalmesactual as $tmactual)

                <div class="info-box-content">
                    <span class="info-box-text"><strong>Meta Mensual</strong></span>
                    <span class="info-box-number">${{number_format($tmactual->totalmesactual)}} / $ 1.000.000</span>
        @endforeach
                <!-- /.info-box-content -->
                </div>
            </div>
        </div>

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
    

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        <i class="fas fa-envelope"></i>
                        Productos más vendidos
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