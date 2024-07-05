<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

// showing all data
    public function all(){
return response()->json(category::all());
}

//selecting
public function show($id)
{
  return response()->json(category::findOrFail($id));
}

//deleteing
public function delete($id)
{
 $category = category::findOrFail($id);
 $category -> delete();
 return response()->json([
'message' => 'has been deleted'
]);
}

// storing
public function insert(Request $request)
{
  $data = $request->validate([
'name' => 'required',
'description' => 'required'
]);
category::create([
'name' => $data['name'],
'description' => $data['description']
]);
return response()->json([
'message' => 'new record has been created'
], 201);
}


// edit/update
public function update(Request $request, $id)
{
 $category = category::findOrFail($id);
 $data = $request->validate([
'name' => 'required',
'description' => 'required'
]);

$category->name = $data['name'];
$category->description = $data['description'];

$category->save();

return response()->json([
'message' => 'record updated'
], 201);

}


}
