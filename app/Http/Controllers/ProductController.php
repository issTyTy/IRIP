<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // showing all data
    public function all() {
        return response()->json(Products::all());
    }

    // selecting
    public function show($id) {
        return response()->json(Products::findOrFail($id));
    }

    // deleting
    public function delete($id) {
        try {
            DB::table('order_details')->where('product_id', $id)->delete(); // Soft delete is recommended
            $product = Products::findOrFail($id);

            if ($product->image) {
                Storage::delete($product->image);
            }

            $product->delete();
            return response()->json([
                'message' => 'Product has been deleted'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }
//storing
    public function insert(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $data['image'] = $imagePath;
        }

        Products::create($data);

        return response()->json([
            'message' => 'New record has been created'
        ], 201);
    }


        //updating
    public function update(Request $request, $id) {
        $product = Products::findOrFail($id);
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048' // Image is not required for update
        ]);
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::delete($product->image);
            }

            $imagePath = $request->file('image')->store('images', 'public');
            $data['image'] = $imagePath;
        }

        $product->update($data);

        return response()->json([
            'message' => 'Record updated'
        ], 201);
    }
}
