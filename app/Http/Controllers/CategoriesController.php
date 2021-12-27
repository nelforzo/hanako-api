<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{

  public function createCategory(Request $request) {
    //validation
    $validator = Validator::make($request->all(), [
      'name' => 'required',
      'description' => 'required',
    ]);

    if ($validator->fails()) {
      return $validator->errors();
    }

    $category = new Categories();

    $category->name = $request->input('name');
    $category->description = $request->input('description');
    $category->save();

    return $category->id;
  }

  public function updateCategory(Request $request) {
    //validation
    $validator = Validator::make($request->all(), [
      'name' => 'required',
      'description' => 'required',
    ]);

    if ($validator->fails()) {
      return $validator->errors();
    }

    $category = Categories::findOrFail($request->input('id'));

    $category->name = $request->input('name');
    $category->description = $request->input('description');
    $category->save();

    return $category->id;
  }

  public function getCategories($user_id) {
    $categories = Categories::where('user_id', $user_id)->get();
    return $categories;
  }

  public function deleteCategory($id) {
    $category = Categories::findOrFail($id);
    $category->delete();
  }
}
