
<div class="form-group">
    <label for="client_id">Cliente</label>
    <select class="form-control" name="client_id" id="client_id">
       
        <option value="1">Nuevo Cliente</option>
       
    </select>
</div>
<div class="form-group">
    <label for="metodo_pago">Metodo Pago</label>
    <select class="form-control" name="metodo_pago" id="metodo_pago">
       
        <option value="EFECTIVO">EFECTIVO</option>
        <option value="TRANSFERENCIA">TRANSFERENCIA</option>
        <option value="DEBITO">DEBITO</option>
        <option value="CREDITO">CREDITO</option>

    </select>
</div>
<!-- 
<div class="form-group col-md-4">
        <div class="form-group">
            <input type="checkbox" data-toggle="toggle" id="pedidosya"  name="pedidosya" class="form-control" data-on="" data-onstyle="success" data-offstyle="danger">         
             
          </div>
    </div> -->

<div class="form-group">
  <label for="code">Código de barras</label>
  <input type="text" name="code" id="code" class="form-control" placeholder="" aria-describedby="helpId">
</div>

<div class="form-row">
    <div class="form-group col-md-4">
        <div class="form-group">
            <label for="product_id">Producto</label>
            <select class="form-control select2bs4" name="product_id" id="product_id">
                <option value="" selected>Selecccione un producto</option>
                @foreach ($productos as $producto)
                <option value="{{$producto->id}}">{{$producto->nombre}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <!-- <div class="form-group col-md-4">
        <div class="form-group">
            <label for="">Stock actual</label>
            <input type="text" name="" id="stock" value="" class="form-control" disabled>
          </div>
    </div> -->
    <div class="form-group col-md-2">
        <div class="form-group">
            <label for="price">Precio de venta</label>
            <input type="number" class="form-control" name="price" id="price" aria-describedby="helpId" disabled>
        </div>
    </div>
 
    <div class="form-group col-md-2">
        <div class="form-group">
            <label for="quantity">Cantidad</label>
            <input type="number" class="form-control" name="quantity" id="quantity" aria-describedby="helpId">
        </div>
    </div>
    
</div>

    <!-- <div class="form-group col-md-3">
        <label for="tax">Impuesto</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3">%</span>
            </div>
            <input type="number" class="form-control" name="tax" id="tax" aria-describedby="basic-addon3" value="0">
        </div>
    </div> -->
    <!-- <div class="form-group col-md-3">
        <label for="discount">Porcentaje de descuento</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon2">%</span>
            </div>
            <input type="number" class="form-control" name="discount" id="discount" aria-describedby="basic-addon2" value="0">
        </div>
    </div> -->
    
        <button type="button" id="agregar" class="btn btn-success float-right mb-4">Agregar producto</button>
   
    <div class="form-group">
        
        <div class="table-responsive col-md-12">
            <table id="detalles" class="table">
                <thead>
                    <tr>
                        <th>Eliminar</th>
                        <th>Producto</th>
                        <th>Precio Venta (CLP)</th>
                        <th>Descuento</th>
                        <th>Cantidad</th>
                        <th>SubTotal (CLP)</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th colspan="5">
                            <p align="right">SUB TOTAL:</p>
                        </th>
                        <th>
                            <p align="right"><span id="total">CLP 00</span> </p>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="5">
                            <p align="right">TOTAL PAGAR:</p>
                        </th>
                        <th>
                            <p align="right"><span align="right" id="total_pagar_html">CLP  00</span> <input type="hidden"
                                    name="total" id="total_pagar"></p>
                        </th>
                    </tr>
                </tfoot>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
