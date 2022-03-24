<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class SubDistrictController extends Controller
{
    public function index(){
        $subdistrict = DB::table('subdistricts')
        ->join('districts' ,'subdistricts.district_id', 'districts.id')
        ->select('subdistricts.*','districts.district_en')  
        ->orderBy('id','desc')->paginate(4);
        return view('backend.subdistrict.index', compact('subdistrict'));
    }
    public function add_subdistrict(){
        $district = DB::table('districts')->get();
        return view('backend.subdistrict.create', compact('district'));
    }

    public function store_subdistrict(Request $request){
        $validatedData = $request->validate([
            'subdistrict_bn' => 'required|unique:subdistricts|max:255',
            'subdistrict_en' => 'required|unique:subdistricts|max:255',
           ]);
    
             $data = array();
             $data['subdistrict_bn'] = $request->subdistrict_bn;
             $data['subdistrict_en'] = $request->subdistrict_en;
             $data['district_id'] = $request->district_id;
             DB::table('subdistricts')->insert($data);

             $note = array(
                 'message' =>'Subdistrict Inserted successfully',
                 'alert-type' => 'success'


             );
    
         return Redirect()->route('subdistrict')->with($note);

    }

    public function edit_subdistrict($id){
        $subdistrict = DB::table('subdistricts')->where('id',$id)->first();
        $district = DB::table('districts')->get();
        return view('backend.subdistrict.edit', compact('subdistrict','district'));

    }

    public function update_subdistrict(Request $request,$id){

        $validatedData = $request->validate([
            'subdistrict_bn' => 'required|unique:subdistricts|max:255',
            'subdistrict_en' => 'required|unique:subdistricts|max:255',
           ]);
    
             $data = array();
             $data['subdistrict_bn'] = $request->subdistrict_bn;
             $data['subdistrict_en'] = $request->subdistrict_en;
             $data['district_id'] = $request->district_id;
             DB::table('subdistricts')->where('id', $id)->update($data);

             $note = array(
                 'message' =>'Subdistrict Updated successfully',
                 'alert-type' => 'success'


             );
    
         return Redirect()->route('subdistrict')->with($note);

    }
    public function delete_subdistrict($id){
        DB::table('subdistricts')->where('id',$id)->delete();
        $note = array(
            'message' =>'Subdistrict Deleted successfully',
            'alert-type' => 'success'


        );

    return Redirect()->route('subdistrict')->with($note);
    }



}
