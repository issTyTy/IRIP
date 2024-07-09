<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;

class ProductController extends Controller
{
    // showing all data
    public function all(){
return response()->json(Products::all());
}

//selecting
public function show($id)
{
  return response()->json(Products::findOrFail($id));
}

//deleteing
public function delete($id)
{
 $Products = Products::findOrFail($id);
 $Products -> delete();
 return response()->json([
'message' => 'has been deleted'
]);
}

// storing
public function insert(Request $request)
{
  $data = $request->validate([
'name' => 'required',
'description' => 'required',
'price' => 'required',
'category_id' => 'required',
'image' => 'required'
]);
Products::create([
'name' => $data['name'],
'description' => $data['description'],
'price' => $data['price'],
'category_id' => $data['category_id'],
'image' => $data['image']
]);
return response()->json([
'message' => 'new record has been created'
], 201);
}


// edit/update
public function update(Request $request, $id)
{
 $Products = Products::findOrFail($id);
 $data = $request->validate([
'name' => 'required',
'description' => 'required',
'price' => 'required',
'category_id' => 'required',
'image' => 'required'
]);

$Products->name = $data['name'];
$Products->description = $data['description'];
$Products->price = $data['price'];
$Products->category_id = $data['category_id'];
$Products->image = $data['image'];

$Products->save();

return response()->json([
'message' => 'record updated'
], 201);

}
}
