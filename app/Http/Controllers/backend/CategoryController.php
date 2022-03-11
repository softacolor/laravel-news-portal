<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class CategoryController extends Controller
{
    public function index(){
        $category = DB::table('categories')->orderBy('id','desc')->paginate(3);
        return view('backend.category.index', compact('category'));
    }
    public function add_category(){
        return view('backend.category.create');
    }

    public function store_category(Request $request){
        $validatedData = $request->validate([
            'category_bn' => 'required|unique:categories|max:255',
            'category_en' => 'required|unique:categories|max:255',
           ]);
    
             $data = array();
             $data['category_bn'] = $request->category_bn;
             $data['category_en'] = $request->category_en;
             DB::table('categories')->insert($data);
    
         return Redirect()->route('categories');

    }
}
