<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\api\ProductRequest;
use App\Http\Requests\Products\api\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        
        $products=Product::all();
        return  SuccessResponse("all products",ProductResource::collection($products));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        //
        $product= $request->validated();
        $newproduct=Product::create($product);
         return  SuccessResponse("new Product created successful", new ProductResource( $newproduct));

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $product=Product::find($id);
        if(!$product)
        {
            return FailResponse("not found this product");
        }
        return SuccessResponse(data: new ProductResource($product));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request,  $id)
    {
        $product=Product::find($id);
        if(!$product)
        {
            return FailResponse("not found this product");
        }
    
         $data=$request->validated();
        $product->update($data);
         return  SuccessResponse(" Product updated successful", new ProductResource($product));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
         $product=Product::find($id);
        if(!$product)
        {
            return FailResponse("not found this product");
        }
        $product->delete();
         return  SuccessResponse("Product deleted successful");

    }
}
