<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class Product_Ctrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        try {
            return Product::all();
        } catch (\Throwable $th) {
            return response()->json(["message" => "Database Error"],500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    { 
        $r->validate([
            'name' => 'required',
            'price' => 'required',
        ]);

        return Product::create($r->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Product::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r, $id)
    {
        $product = Product::find($id);
        $product->update( $r->all() );
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Product::destroy($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $name 
     */
    public function search($name)
    {

        return Product::where('name','like',"%$name%")->get();;
    }
}
