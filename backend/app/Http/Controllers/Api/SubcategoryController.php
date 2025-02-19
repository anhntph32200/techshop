<?php

// app/Http/Controllers/Api/SubcategoryController.php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function index()
    {
        return Subcategory::with('category')->get();
    }

    public function show($id)
    {
        return Subcategory::with('category')->findOrFail($id);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|string',
            'status' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $subcategory = Subcategory::create($request->all());
        
        return response()->json([
            'message' => 'Subcategory created successfully',
            'data' => $subcategory,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $subcategory = Subcategory::findOrFail($id);

        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'image' => 'nullable|string',
            'status' => 'nullable|string',
            'category_id' => 'sometimes|required|exists:categories,id',
        ]);

        $subcategory->update($request->all());
        
        return response()->json([
            'message' => 'Subcategory updated successfully',
            'data' => $subcategory,
        ], 200);
    }

    public function destroy($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $subcategory->delete();
        
        return response()->json(null, 204);
    }
}

