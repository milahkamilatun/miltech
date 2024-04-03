<?php

namespace App\Http\Controllers;

use App\Models\ProduckType;
use App\Models\Produck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProduckController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Produck::all();
        return view('producks.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product_types = ProduckType::all();
        return view('producks.create', compact('product_types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'qty' => 'required',
            'selling_price' => 'required',
            'buyying_price' => 'required',
            'product_type' => 'required',
            //'product_status' => 'required',
        ]);

        $data = $request->all();
        // dd($data);
        $check = Produck::create([
            'product_name' => $data['product_name'],
            'qty' => $data['qty'],
            'selling_price' =>$data['selling_price'],
            'buyying_price' =>$data['buyying_price'],
            'product_type_id' =>$data['product_type'],
            //'product_status' =>$data['product_status']
        ]);

        return redirect()->route('producks.index')->withSuccess('Great! You have successfully created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

        /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $produck = Produck::find($id);
        $product_types = ProduckType::all();
        return view('producks.edit', compact('product_types', 'produck'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produck $produck)
    {
        $request->validate([
            'product_name'=> 'required',
            'qty'=> 'required',
            'selling_price'=> 'required',
            'buyying_price'=> 'required',
            'product_type'=> 'required',
        ]);

        $produck->product_name = $request->product_name;
        $produck->qty = $request->qty;
        $produck->selling_price = $request->selling_price;
        $produck->buyying_price = $request->buyying_price;
        $produck->product_type_id = $request->product_type;
        $produck->save();

        return redirect()->route('producks.index')->withSuccess('Great! You have successfully updated '.$produck->product_name);
    }

     /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produck $produck)
    {
        $produck->delete();

        return redirect()->route('producks.index')
        ->withSuccess('Great! You have successfully deleted '.$produck->product_name);
    }
}
