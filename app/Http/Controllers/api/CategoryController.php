<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
// use Illuminate\Support\Facades\Auth; 
// use Validator;
use DB;

class CategoryController extends Controller
{
	public $successStatus = 200;

	public function getSubCategory(Request $request){ 

		$name = $request->get('query');

		$category = DB::table('sub_categories')
					->where('sub_category_name', 'like', $name.'%')
					->get(['sub_category_name']);

		return response()->json($category); 

	}

	public function getcategory(Request $request){ 

		$name = $request->get('query');

		$category = DB::table('category')
					->where('name', 'like', $name.'%')
					->get(['id', 'name']);

		return response()->json($category); 

	}

}

?>