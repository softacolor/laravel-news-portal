<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class CategoryController extends Controller
{
    public function index(){
        $category = DB::table('categories')->orderBy('id','desc')->paginate(4);
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

             $note = array(
                 'message' =>'Category Inserted successfully',
                 'alert-type' => 'success'


             );
    
         return Redirect()->route('categories')->with($note);

    }

    public function edit_category($id){
        $category = DB::table('categories')->where('id',$id)->first();
        return view('backend.category.edit', compact('category'));

    }

    public function update_category(Request $request,$id){

        $validatedData = $request->validate([
            'category_bn' => 'required|unique:categories|max:255',
            'category_en' => 'required|unique:categories|max:255',
           ]);
    
             $data = array();
             $data['category_bn'] = $request->category_bn;
             $data['category_en'] = $request->category_en;
             DB::table('categories')->where('id', $id)->update($data);

             $note = array(
                 'message' =>'Category Updated successfully',
                 'alert-type' => 'success'


             );
    
         return Redirect()->route('categories')->with($note);


    }

    public function delete_category($id){
        DB::table('categories')->where('id',$id)->delete();
        $note = array(
            'message' =>'Category Deleted successfully',
            'alert-type' => 'success'


        );

    return Redirect()->route('categories')->with($note);
    }
}
