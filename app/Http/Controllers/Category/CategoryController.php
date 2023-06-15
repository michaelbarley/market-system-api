<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller

{
    public function index()
    {
        return response()->json(['data' => Category::all()], 200);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'description' => 'required',
        ];

        $this->validate($request, $rules);

        $category = Category::create($request->all());

        return response()->json(['data' => $category], 201);
    }

    public function show(Category $category)
    {
        return response()->json(['data' => $category], 200);
    }

    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string|max:1000',
        ]);

        $category->fill($validatedData);

        if (!$category->isDirty()) {
            return response()->json([
                'error' => 'You need to specify a different value in order to update',
                'code' => 422
            ], 422);
        }

        $category->save();

        return response()->json(['data' => $category], 200);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json(['data' => Category::all()], 200);
    }
}
