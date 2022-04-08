<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Image;

class PostController extends Controller
{

  public function __construct(){
    $this->middleware('auth');
  }

  
	public function index(){
		$post = DB::table('posts')
			->join('categories','posts.category_id','categories.id')
			->join('subcategories','posts.subcategory_id','subcategories.id')
			->join('districts','posts.district_id','districts.id')
			->join('subdistricts','posts.subdistrict_id','subdistricts.id')
			->select('posts.*','categories.category_bn','subcategories.subcategory_bn','districts.district_bn','subdistricts.subdistrict_bn')
			->orderBy('id','desc')->paginate(5);
			return view('backend.post.index',compact('post'));

	}

 



    public function Create(){

    	$category = DB::table('categories')->get();
    	$district = DB::table('districts')->get();
    	return view('backend.post.create',compact('category','district'));

    }


  public function StorePost(Request $request){

  	 $validatedData = $request->validate([
        'category_id' => 'required',
        'district_id' => 'required',
       ]);


  	 $data = array();
  	 $data['title_bn'] = $request->title_bn;
  	 $data['title_en'] = $request->title_en;
  	 $data['user_id'] = Auth::id();
  	 $data['category_id'] = $request->category_id;
  	 $data['subcategory_id'] = $request->subcategory_id;
  	 $data['district_id'] = $request->district_id;
  	 $data['subdistrict_id'] = $request->subdistrict_id;
  	 $data['tags_bn'] = $request->tags_bn;
  	 $data['tags_en'] = $request->tags_en;
  	 $data['details_bn'] = $request->details_bn;
  	 $data['details_en'] = $request->details_en;
  	 $data['headline'] = $request->headline;
  	 $data['first_section'] = $request->first_section;
  	 $data['first_section_thumbnail'] = $request->first_section_thumbnail;
     $data['bigthumbnail'] = $request->bigthumbnail;
  	 $data['post_date'] = date('d-m-Y');
  	 $data['post_month'] = date("F");


  	 $image = $request->image;
  	 	if ($image) {
  	 		$image_one = uniqid().'.'.$image->getClientOriginalExtension(); 
  	 		Image::make($image)->resize(500,300)->save('image/postimg/'.$image_one);
  	 		$data['image'] = 'image/postimg/'.$image_one;
  	 		// image/postimg/343434.png
  	 		DB::table('posts')->insert($data);

  	 		$notification = array(
    	 	'message' => 'Post Inserted Successfully',
    	 	'alert-type' => 'success'
    	 );

    	 return Redirect()->route('all.post')->with($notification);
  	 	
  	 	}else{
  	 		return Redirect()->back();
  	 	} // End Condition


  }  // END Method 




  public function EditPost($id){

  	$post = DB::table('posts')->where('id',$id)->first();
  	$category = DB::table('categories')->get();
  	$district = DB::table('districts')->get();
  	return view('backend.post.edit',compact('post','category','district'));

  }


  public function UpdatePost(Request $request, $id){
     
     $data = array();
  	 $data['title_bn'] = $request->title_bn;
  	 $data['title_en'] = $request->title_en;
  	 $data['user_id'] = Auth::id();
  	 $data['category_id'] = $request->category_id;
  	 $data['subcategory_id'] = $request->subcategory_id;
  	 $data['district_id'] = $request->district_id;
  	 $data['subdistrict_id'] = $request->subdistrict_id;
  	 $data['tags_bn'] = $request->tags_bn;
  	 $data['tags_en'] = $request->tags_en;
  	 $data['details_bn'] = $request->details_bn;
  	 $data['details_en'] = $request->details_en;
  	 $data['headline'] = $request->headline;
  	 $data['first_section'] = $request->first_section;
  	 $data['first_section_thumbnail'] = $request->first_section_thumbnail;
     $data['bigthumbnail'] = $request->bigthumbnail;
 

     $oldimage = $request->oldimage;
  	 $image = $request->image;
  	 	if ($image) {
  	 		$image_one = uniqid().'.'.$image->getClientOriginalExtension(); 
  	 		Image::make($image)->resize(500,300)->save('image/postimg/'.$image_one);
  	 		$data['image'] = 'image/postimg/'.$image_one;
  	 		// image/postimg/343434.png
  	 		DB::table('posts')->where('id',$id)->update($data);
  	 		unlink($oldimage);

  	 		$notification = array(
    	 	'message' => 'Post Updated Successfully',
    	 	'alert-type' => 'success'
    	 );

    	 return Redirect()->route('all.post')->with($notification);
  	 	
  	 	}else{
  	 		$data['image'] = $oldimage;
  	 		DB::table('posts')->where('id',$id)->update($data);
  	 		 
  	 		$notification = array(
    	 	'message' => 'Post Updated Successfully',
    	 	'alert-type' => 'success'
    	 );
         return Redirect()->route('all.post')->with($notification);
  	 	} // End Condition
  }  // End Method
 


 public function DeletePost($id){
 	$post = DB::table('posts')->where('id',$id)->first();
 	unlink($post->image);

 	DB::table('posts')->where('id',$id)->delete();

 	$notification = array(
    	 	'message' => 'Post Deleted Successfully',
    	 	'alert-type' => 'error'
    	 );

    	 return Redirect()->route('all.post')->with($notification);
 }



  public function GetSubCategory($category_id){
  $sub = DB::table('subcategories')->where('category_id',$category_id)->get();
  return response()->json($sub);

    }


  public function GetSubDistrict($district_id){
  $sub = DB::table('subdistricts')->where('district_id',$district_id)->get();
  return response()->json($sub);

    }





}
