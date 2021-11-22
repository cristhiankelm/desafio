<?php

namespace App\Http\Controllers;

use App\Category;
use App\Helpers\APIHelpers;
use Illuminate\Http\Request;
use App\Http\Requests\Category as CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        $response = APIHelpers::createAPIResponse(false, 200, '', $categories);
        return response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $category = new Category();

        $category->name_category = $request->name_category;
        $category->status = $request->status;
        $category->created_at = date(now());
        $category->updated_at = date(now());

        $categorySave = $category->save();

        if ($categorySave) {
            $response = APIHelpers::createAPIResponse(false, 201, 'Category added successfully', null);
            return response()->json($response, 201);
        } else {
            $response = APIHelpers::createAPIResponse(true, 400, 'Category creation failed', null);
            return response()->json($response, 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categories = Category::findOrFail($id);

        $response = APIHelpers::createAPIResponse(false, 200, '', $categories);
        return response()->json($response, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);

        $category->name_category = is_null($request->name_category) ? $category->name_category : $request->name_category;
        $category->status = is_null($request->status) ? $category->status : $request->status;
        $category->updated_at = date(now());

        $categoryUpdate = $category->save();

        if ($categoryUpdate) {
            $response = APIHelpers::createAPIResponse(false, 200, 'Category updated successfully', null);
            return response()->json($response, 200);
        } else {
            $response = APIHelpers::createAPIResponse(true, 400, 'Category update failed', null);
            return response()->json($response, 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $categoryDelete = $category->delete();

        if ($categoryDelete) {
            $response = APIHelpers::createAPIResponse(false, 200, 'Category deleted successfully', null);
            return response()->json($response, 200);
        } else {
            $response = APIHelpers::createAPIResponse(true, 400, 'Category delete failed', null);
            return response()->json($response, 400);
        }
    }
}
