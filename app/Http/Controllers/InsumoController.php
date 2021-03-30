<?php

namespace App\Http\Controllers;

use App\Insumo;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InsumoController extends Controller
{
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
        $gasto = $request->stock* $request->precioCompra;

        // dd($gasto);
        $insrumo = Insumo::create($request->all());
        return redirect()->route('insumos.index');  
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Insumo  $insumo
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Insumo $insumo)
    // {
    //     $insumo->delete();
    //     return redirect()->route('insumos.index');
    // }

    public function delete($id)
    {
        $delete = User::where('id', $id)->delete();
        // check data deleted or not
        if ($delete == 1) {
            $success = true;
            $message = "User deleted successfully";
        } else {
            $success = true;
            $message = "User not found";
        }
        //  Return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
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
