<?php

namespace App\Http\Controllers;

use App\Insumo;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;


class InsumoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $insumos = Insumo::get();
        return view('admin.insumo.index' , compact('insumos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.insumo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $insrumo = Insumo::create($request->all());
        return redirect()->route('insumos.index')->with('toast_success', 'Creado Exitosamente!');  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Insumo  $insumo
     * @return \Illuminate\Http\Response
     */
    public function show(Insumo $insumo)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Insumo  $insumo
     * @return \Illuminate\Http\Response
     */
    public function edit(Insumo $insumo)
    {
        dd("sda");
    }

    public function editInsumo(Request $request)
    {
      
        $id = $request->id;
        $insumo = Insumo::find($id)->update(['stock'=>$request->cantidad, 'precioCompra'=>$request->precioCompra]);
        if($insumo){
            return redirect()->route('insumos.index')->with('toast_success', 'Modificdo Exitosamente!');  
        }else{
            return redirect()->route('insumos.index')->with('toast_error', 'Ops Algo salio mal!');  
        }  
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Insumo  $insumo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Insumo $insumo)
    {
        
        $insumo = Insumo::find($insumo->id)->update(['stock'=>$request->cantidad]);
        return redirect()->route('insumos.index')->with('toast_success', 'Modificdo Exitosamente!');  
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Insumo  $insumo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Insumo $insumo)
    {
        $insumo->delete();
        return redirect()->route('insumos.index')->with('toast_success', 'Eliminado Exitosamente!');
    }

    public function change_status( Insumo $insumo)
    {
        // dd($insumo);
        if ($insumo->estado == 'ACTIVO') {
            $insumo = Insumo::find($insumo->id)->update(['estado'=>'DESACTIVADO']);
            return redirect()->back();
        } else {
            $insumo->update(['estado'=>'ACTIVO']);
            return redirect()->back();
        } 
    }
}
