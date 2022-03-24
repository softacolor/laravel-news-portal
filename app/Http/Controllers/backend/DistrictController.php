<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class DistrictController extends Controller
{
    public function index(){
        $district = DB::table('districts')->orderBy('id','desc')->paginate(4);
        return view('backend.district.index', compact('district'));
    }
    public function add_district(){
        return view('backend.district.create');
    }

    public function store_district(Request $request){
        $validatedData = $request->validate([
            'district_bn' => 'required|unique:districts|max:255',
            'district_en' => 'required|unique:districts|max:255',
           ]);
    
             $data = array();
             $data['district_bn'] = $request->district_bn;
             $data['district_en'] = $request->district_en;
             DB::table('districts')->insert($data);

             $note = array(
                 'message' =>'District Inserted successfully',
                 'alert-type' => 'success'


             );
    
         return Redirect()->route('district')->with($note);

    }

    public function edit_district($id){
        $district = DB::table('districts')->where('id',$id)->first();
        return view('backend.district.edit', compact('district'));

    }

    public function update_district(Request $request,$id){

        $validatedData = $request->validate([
            'district_bn' => 'required|unique:districts|max:255',
            'district_en' => 'required|unique:districts|max:255',
           ]);
    
             $data = array();
             $data['district_bn'] = $request->district_bn;
             $data['district_en'] = $request->district_en;
             DB::table('districts')->where('id', $id)->update($data);

             $note = array(
                 'message' =>'District Updated successfully',
                 'alert-type' => 'success'


             );
    
         return Redirect()->route('district')->with($note);


    }

    public function delete_district($id){
        DB::table('districts')->where('id',$id)->delete();
        $note = array(
            'message' =>'District Deleted successfully',
            'alert-type' => 'success'


        );

    return Redirect()->route('district')->with($note);
    }
}
