<?php

namespace App\Http\Controllers;

use App\Category;
use App\Helpers\APIHelpers;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests\Product as ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        $response = APIHelpers::createAPIResponse(false, 200, '', $products);
        return response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = new Product();

        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->inventory = $request->inventory;
        $product->status = $request->status;
        $product->created_at = date(now());
        $product->updated_at = date(now());

        $productSave = $product->save();

        if ($productSave) {
            $response = APIHelpers::createAPIResponse(false, 201, 'Product added successfully', null);
            return response()->json($response, 201);
        } else {
            $response = APIHelpers::createAPIResponse(true, 400, 'Product creation failed', null);
            return response()->json($response, 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        $response = APIHelpers::createAPIResponse(false, 200, '', $product);
        return response()->json($response, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Product::find($id);

        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->inventory = $request->inventory;
        $product->status = $request->status;
        $product->updated_at = date(now());

        $productSave = $product->save();

        if ($productSave) {
            $response = APIHelpers::createAPIResponse(false, 200, 'Product updated successfully', null);
            return response()->json($response, 200);
        } else {
            $response = APIHelpers::createAPIResponse(true, 400, 'Product update failed', null);
            return response()->json($response, 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $productDelete = $product->delete();

        if ($productDelete) {
            $response = APIHelpers::createAPIResponse(false, 200, 'Product deleted successfully', null);
            return response()->json($response, 200);
        } else {
            $response = APIHelpers::createAPIResponse(true, 400, 'Product delete failed', null);
            return response()->json($response, 400);
        }
    }
}
