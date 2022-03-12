<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class SubcategoryController extends Controller
{
    public function index(){
        $subcategory = DB::table('subcategories')
        ->join('categories' ,'subcategories.category_id', 'categories.id')
        ->select('subcategories.*','categories.category_en')  
        ->orderBy('id','desc')->paginate(4);
        return view('backend.subcategory.index', compact('subcategory'));
    }
    public function add_subcategory(){
        $category = DB::table('categories')->get();
        return view('backend.subcategory.create', compact('category'));
    }

    public function store_subcategory(Request $request){
        $validatedData = $request->validate([
            'subcategory_bn' => 'required|unique:subcategories|max:255',
            'subcategory_en' => 'required|unique:subcategories|max:255',
           ]);
    
             $data = array();
             $data['subcategory_bn'] = $request->subcategory_bn;
             $data['subcategory_en'] = $request->subcategory_en;
             $data['category_id'] = $request->category_id;
             DB::table('subcategories')->insert($data);

             $note = array(
                 'message' =>'Subcategory Inserted successfully',
                 'alert-type' => 'success'


             );
    
         return Redirect()->route('subcategories')->with($note);

    }

    public function edit_subcategory($id){
        $subcategory = DB::table('subcategories')->where('id',$id)->first();
        $category = DB::table('categories')->get();
        return view('backend.subcategory.edit', compact('subcategory','category'));

    }

    public function update_subcategory(Request $request,$id){

        $validatedData = $request->validate([
            'subcategory_bn' => 'required|unique:subcategories|max:255',
            'subcategory_en' => 'required|unique:subcategories|max:255',
           ]);
    
             $data = array();
             $data['subcategory_bn'] = $request->subcategory_bn;
             $data['subcategory_en'] = $request->subcategory_en;
             $data['category_id'] = $request->category_id;
             DB::table('subcategories')->where('id', $id)->update($data);

             $note = array(
                 'message' =>'Subcategory Updated successfully',
                 'alert-type' => 'success'


             );
    
         return Redirect()->route('subcategories')->with($note);

    }
    public function delete_subcategory($id){
        DB::table('subcategories')->where('id',$id)->delete();
        $note = array(
            'message' =>'Subcategory Deleted successfully',
            'alert-type' => 'success'


        );

    return Redirect()->route('subcategories')->with($note);
    }



}
