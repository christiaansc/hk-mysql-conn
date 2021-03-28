<?php

namespace App\Http\Controllers;


use App\Venta;
use Carbon\Carbon;

use Illuminate\Http\Request;

class ReportController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function reports_day(){

        $sales = Venta::WhereDate('fecha_venta', Carbon::today('America/Santiago'))->get();
        $total = $sales->sum('total');
        return view('admin.reporte.reporte_dia', compact('sales', 'total'));
    }
    public function reports_date(){
        $sales = Venta::whereDate('fecha_venta', Carbon::today('America/Santiago'))->get();
        $total = $sales->sum('total');
        return view('admin.reporte.reporte_fecha', compact('sales', 'total'));
    }
    public function report_results(Request $request){
        $fi = $request->fecha_ini. ' 00:00:00';
        $ff = $request->fecha_fin. ' 23:59:59';
        
        $sales = Venta::whereBetween('fecha_venta', [$fi, $ff])->get();
        $total = $sales->sum('total');
        
        return view('admin.reporte.reporte_fecha', compact('sales', 'total')); 
    }
}
