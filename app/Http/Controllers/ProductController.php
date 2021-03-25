<?php

namespace App\Http\Controllers;

use App\Product;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::get();
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $categorias = Categoria::get();
        // $proveedores = Prover::get();
        $categorias = ['id'=> 3,'nombre' =>'waffles Bike'];
        $proveedores = ['id'=> 1 , 'nombre'=>'waffles'];
        return view('admin.product.create', compact('categorias', 'proveedores'));
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image_name ='';
        if($request->hasFile('picture')){
            $file = $request->file('picture');
            $image_name = time().'_'.$file->getClientOriginalName();
            $file->move(public_path("/image"),$image_name);
        }
        $product = Product::create($request->all()+[
            'image'=>$image_name,
        ]);
        if ($product->codigo == "") {
            $numero = $product->id;
            $numeroConCeros = str_pad($numero, 8, "0", STR_PAD_LEFT);
            $waffle->update(['codigo'=>$numeroConCeros]);
        }
        return redirect()->route('products.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.product.show', compact('product'));    
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        // $categorias = Categoria::get();
        // $provers = Prover::get();
        $categorias = ['id'=> 3,'nombre' =>'waffles Bike'];
        $proveedores = ['id'=> 1 , 'nombre'=>'waffles'];
        return view('admin.product.edit', compact('product', 'categorias', 'proveedores'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        if($request->hasFile('picture')){
            $file = $request->file('picture');
            $image_name = time().'_'.$file->getClientOriginalName();
            $file->move(public_path("/image"),$image_name);
        }else{
            $image_name = $product->image;
        }
        $product->update($request->all()+[
            'image'=>$image_name,
        ]);
        if ($request->codigo == "") {
            $numero = $product->id;
            $numeroConCeros = str_pad($numero, 8, "0", STR_PAD_LEFT);
            $product->update(['codigo'=>$numeroConCeros]);
        }
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $image_path = public_path().'/image/'.$product->image;   
        if(File::exists($image_path)){     
            File::delete(public_path('/image/'.$product->image)); 
        }
        $product->delete();
        return redirect()->route('products.index');
    }
}
