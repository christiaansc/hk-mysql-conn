@extends('layouts.dashboard')
@section('title','Gestión de Ventas')

@section('breadcrumb')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Registro  de Ventas</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>  
                    <li class="breadcrumb-item"><a href="/ventas">ventas</a></li>      
                    <li class="breadcrumb-item active">Registro de ventas</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection
@section('content')
<div class="container-fluid">
    <div class="col-lg-12">
        <div class="card">
            {!! Form::open(['route'=>'ventas.store', 'method'=>'POST']) !!}
            <div class="card-body">
                
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">Registro de venta</h4>
                </div>
                
                @include('admin.ventas._form')
                    
                    
            </div>
            <div class="card-footer text-muted">
                <button type="submit" id="guardar" class="btn btn-primary float-right">Registrar</button>
                    <a href="{{route('ventas.index')}}" class="btn btn-danger">
                    Cancelar
                    </a>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    
$(document).ready(function () {
    $("#agregar").click(function () {
        agregar();
    });
});

var cont = 1;
total = 0;
subtotal = [];
$("#guardar").hide();

$("#product_id").change(mostrarValores);
function mostrarValores() {
    datosProducto = document.getElementById('product_id').value.split('_');

    $("#price").val(datosProducto[2]);
    $("#stock").val(datosProducto[1]);
    // alert( product_id );
    // console.log (JSON.stringify(datosProducto));
}

var product_id2 = $('#product_id');

    product_id2.change(function(){
        
        $.ajax({
            url: "{{route('get_products_by_id')}}",
            method: 'GET',
            data:{
                product_id: product_id2.val(),
            },
            success: function(data){

                // console.log(data);
                $("#price").val(data.precio);
                $("#code").val(data.codigo);
        }
    });
});


$(obtener_registro());

function obtener_registro(code){
    $.ajax({
        url: "{{route('get_products_by_barcode')}}",
        type: 'GET',
        data:{
            code: code
        },
        dataType: 'json',
        success:function(data){
            // console.log(data);
            $("#price").val(data.precio);
            $("#stock").val(data.stock);
            $("#product_id").val(data.id);
        }
    });
}
$(document).on('keyup', '#code', function(){
    var valorResultado = $(this).val();
    if(valorResultado!=""){
        obtener_registro(valorResultado);
    }else{
        obtener_registro();
    }
})


function agregar() {
    datosProducto = document.getElementById('product_id').value.split('_');
    product_id = datosProducto[0];
    producto = $("#product_id option:selected").text();
    quantity = $("#quantity").val();
    discount = $("#discount").val();
    price = $("#price").val();
    stock = $("#stock").val();
    impuesto = $("#tax").val();
    if (product_id != "" && quantity != "" && quantity > 0 && discount != "" && price != "") {
        
            subtotal[cont] = (quantity * price) - (quantity * price * discount / 100);
            total = total + subtotal[cont];
            var fila = '<tr class="selected" id="fila' + cont + '"><td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar(' + cont + ');"><i class="fa fa-times fa-2x"></i></button></td> <td><input type="hidden" name="product_id[]" value="' + product_id + '">' + producto + '</td> <td> <input type="hidden" name="price[]" value="' + parseInt(price) + '"> <input class="form-control" type="number" value="' + parseInt(price) + '" disabled> </td> <td> <input type="hidden" name="discount[]" value="' + parseInt(discount) + '"> <input class="form-control" type="number" value="' + parseInt(discount) + '" disabled> </td> <td> <input type="hidden" name="quantity[]" value="' + quantity + '"> <input type="number" value="' + quantity + '" class="form-control" disabled> </td> <td align="right">s/' + parseInt(subtotal[cont]) + '</td></tr>';
            cont++;
            limpiar();
            totales();
            evaluar();
            $('#detalles').append(fila);
        
    } else {
            swal.fire({
                title: "Debes Completar los campos obligatorios!",
                button: "Close", // Text on button
                icon: "error", //built in icons: success, warning, error, info
                
                buttons: {
                    confirm: {
                    text: "OK",
                    value: true,
                    visible: true,
                    closeModal: true
                    }
                }
            });
    }
}
function limpiar() {
    $("#quantity").val("");
    $("#discount").val("0");
}
function totales() {
    $("#total").html("CLP " + total);

    ;
    total_pagar = total ;
   
    $("#total_pagar_html").html("CLP " + total_pagar);
    $("#total_pagar").val(total_pagar);
}
function evaluar() {
    if (total > 0) {
        $("#guardar").show();
    } else {
        $("#guardar").hide();
    }
}
function eliminar(index) {
    total = total - subtotal[index];
    total_impuesto = total * impuesto / 100;
    total_pagar_html = total + total_impuesto;
    $("#total").html("PEN" + total);
    $("#total_impuesto").html("PEN" + total_impuesto);
    $("#total_pagar_html").html("PEN" + total_pagar_html);
    $("#total_pagar").val(total_pagar_html.toFixed(2));
    $("#fila" + index).remove();
    evaluar();
}

</script>
@endsection