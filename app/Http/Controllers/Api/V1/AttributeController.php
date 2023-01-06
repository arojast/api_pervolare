<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\V1\ProductResource;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductResource::collection(Product::latest()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attribute = new Attribute();
        $attribute->name = $request->input('name');
        $attribute->type = $request->input('type');
        $attribute->product_id = $request->input('product_id');
        $attribute->save();

        return response()->json([
            'message' => 'Success'
        ],204);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attribute $attribute)
    {
        $attribute->name = $request->input('name');
        $attribute->type = $request->input('type');
        $attribute->product_id = $request->input('product_id');
        $attribute->save();

        return response()->json([
            'message' => 'Success'
        ],204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attribute $attribute)
    {
        if($attribute->delete()){
            return response()->json([
                'message' => 'Success'
            ],204);
        } 

        return response()->json([
            'message' => 'Not found'
        ],404);
    }
}
