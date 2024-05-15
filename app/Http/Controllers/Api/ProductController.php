<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produck;
use App\Models\ProduckType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Produck::paginate($request->perPage);
        return response()->json($products);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required',
            'qty' => 'required',
            'selling_price' => 'required',
            'buyying_price' => 'required',
            'product_type_id' => 'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $produck = Produck::create([
            'product_name' => $request->product_name,
            'qty' => $request->qty,
            'selling_price' => $request->selling_price,
            'buyying_price' => $request->buyying_price,
            'product_type_id' => $request->product_type_id,
        ]);
        return response()->json([
            'message' => 'Ruangan successfully created',
            'ruangan' => $produck
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Produck $produck)
    {
        return response()->json($produck);
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

