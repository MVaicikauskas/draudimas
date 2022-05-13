<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('name','asc')->get();

        return view('productsIndex', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('productAdd');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'required|max:2000'
        ], [
            'name.required' => 'Produkto pavadinimas privalo būti įrašytas.',
            'name.max:255' => 'Produkto pavadinimo ilgis negali būti ilgesnis nei 255 simboliai.',
            'description.required' => 'Produkto Aprašymas privalo būti įrašyta.',
            'description.max:255' => 'Produkto Aprašymas ilgis negali būti ilgesnis nei 2000 simbolių.'
        ]);

        $product = new Product();
        $product->name=$request->name;
        $product->description=$request->description;
        $product->save();
        return redirect('/products')->with('success', 'Produktas įrašytas sėkmingai.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Product $product)
    {
        $product = Product::find($id);

        return view('productUpdate', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, Product $product)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'required|max:2000'
        ], [
            'name.required' => 'Produkto pavadinimas privalo būti įrašytas.',
            'name.max:255' => 'Produkto pavadinimo ilgis negali būti ilgesnis nei 255 simboliai.',
            'description.required' => 'Produkto Aprašymas privalo būti įrašyta.',
            'description.max:255' => 'Produkto Aprašymas ilgis negali būti ilgesnis nei 2000 simbolių.'
        ]);

        $product = DB::table('products')
              ->where('id', $id)
              ->update(['name' => $request->name, 'description' => $request->description]);

              return redirect('/products')->with('success', 'Produktas atnaujintas sėkmingai.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Product $product)
    {
        $product = DB::table('products')->where('id', $id)->delete();
        return redirect('/products')->with('success', 'Produktas ištrintas sėkmingai.');
    }
}
