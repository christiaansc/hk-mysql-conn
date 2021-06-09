<?php

namespace App\Http\Controllers;

use App\Venta;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

              $ventasmes=DB::select('SELECT monthname(v.fecha_venta) as mes, sum(v.total) as totalmes from ventas v where v.stado="VALIDO" group by monthname(v.fecha_venta) ');
      
              $ventasdia=DB::select('SELECT DATE(fecha_venta) as dia ,SUM(total) as totalpordia from ventas WHERE stado="VALIDO"  group by DATE(fecha_venta)');
              
              $totales=DB::select('SELECT sum(v.total) as totalventa from ventas v where DATE(v.fecha_venta)=curdate() and v.stado="VALIDO"');
              
              $productosvendidos=DB::select('SELECT p.codigo as code, 
              sum(dv.cantidad) as quantity, p.nombre as name , p.id as id , p.stock as stock from products p 
              inner join venta_detalles dv on p.id=dv.product_id 
              inner join ventas v on dv.venta_id=v.id where v.stado="VALIDO" 
              and month(v.fecha_venta)=month(curdate()) 
              group by p.codigo ,p.nombre, p.id , p.stock order by sum(dv.cantidad) desc limit 10');

              $productos_vendidos_dia=DB::select('SELECT p.codigo as code, 
              sum(dv.cantidad) as quantity, p.nombre as name , p.id as id , p.stock as stock from products p 
              inner join venta_detalles dv on p.id=dv.product_id 
              inner join ventas v on dv.venta_id=v.id where v.stado="VALIDO" 
              and date(v.fecha_venta) = curdate()
              group by p.codigo ,p.nombre, p.id , p.stock order by sum(dv.cantidad) desc limit 10');
             
            //  $sales = Venta::WhereDate('fecha_venta', Carbon::today('America/Santiago'))->get();
            //  $totaldia = $sales->sum('total');

             $totaldia2 = DB::select('SELECT sum(total) as totaldia FROM ventas where date(fecha_venta) = curdate() and stado = "VALIDO"');
                         
             $totalm= DB::select('SELECT sum(v.total) as totalmes from ventas v where v.stado="VALIDO"');

             $totalDiaAnt= DB::select('SELECT sum(total) as totalAnt from ventas  where DATE(fecha_venta) =  DATE_SUB(curdate(),INTERVAL 1 DAY) AND stado="VALIDO"');

             $totalmesactual = DB::select('SELECT sum(v.total) as totalmesactual from ventas v where v.stado="VALIDO" and month(v.fecha_venta) = month(now())');

            $t_efectivo      = DB::select('SELECT sum(total) as totalefectivo FROM ventas WHERE metodo_pago = "EFECTIVO" AND stado = "VALIDO" AND month(fecha_venta) = month(now())');
            $t_transferencia = DB::select('SELECT sum(total) as totaltransferencia FROM ventas WHERE metodo_pago = "TRANSFERENCIA" AND stado = "VALIDO" AND month(fecha_venta) = month(now())');
            $t_debito        = DB::select('SELECT sum(total) as totaldebito FROM ventas WHERE metodo_pago = "DEBITO" AND stado = "VALIDO" AND month(fecha_venta) = month(now())');
            $t_credito       = DB::select('SELECT sum(total) as totalcredito FROM ventas WHERE metodo_pago = "CREDITO" AND stado = "VALIDO" AND month(fecha_venta) = month(now())');



            // dd($t_transferencia);
              return view('home', compact(  'ventasmes',
                'ventasdia',
                'totales',
                'productosvendidos',
                'productos_vendidos_dia',
                'totalm',
                'totalmesactual',
                'totalDiaAnt',
                'totaldia2',
                't_efectivo',
                't_transferencia',
                't_debito',
                't_credito'
            ));
    }
}
