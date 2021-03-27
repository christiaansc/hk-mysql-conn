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
            //   $ventasmes=DB::select('SELECT month(v.fecha_venta) as mes, sum(v.total) as totalmes from ventas v where v.stado="VALIDO" group by month(v.fecha_venta) order by month(v.fecha_venta) desc limit 12');


              $ventasmes=DB::select('SELECT monthname(v.fecha_venta) as mes, sum(v.total) as totalmes from ventas v where v.stado="VALIDO" group by monthname(v.fecha_venta) ');
      
              $ventasdia=DB::select('SELECT DATE_FORMAT(v.fecha_venta,"%d/%m/%Y") as dia, sum(v.total) as totaldia from ventas v where v.stado="VALIDO" group by v.fecha_venta order by day(v.fecha_venta) desc limit 15');
              
              $totales=DB::select('SELECT sum(v.total) as totalventa from ventas v where DATE(v.fecha_venta)=curdate() and v.stado="VALIDO"');
              
              $productosvendidos=DB::select('SELECT p.codigo as code, 
              sum(dv.cantidad) as quantity, p.nombre as name , p.id as id , p.stock as stock from products p 
              inner join venta_detalles dv on p.id=dv.product_id 
              inner join ventas v on dv.venta_id=v.id where v.stado="VALIDO" 
              and year(v.fecha_venta)=year(curdate()) 
              group by p.codigo ,p.nombre, p.id , p.stock order by sum(dv.cantidad) desc limit 10');
             
             $sales = Venta::WhereDate('fecha_venta', Carbon::today('America/Santiago'))->get();
             $totaldia = $sales->sum('total');

             
             $totalm= DB::select('SELECT sum(v.total) as totalmes from ventas v where v.stado="VALIDO"');

                // dd($totalmes);
        

              return view('home', compact(  'ventasmes', 'ventasdia', 'totales', 'productosvendidos', 'totaldia','totalm'));
    }
}
