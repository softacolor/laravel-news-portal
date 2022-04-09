<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Image;

class GalleryController extends Controller
{
    public function photo_gallery(){
        $photo = DB::table('photos')->orderBy('id',('desc'))->paginate(5);
        return view('backend.gallery.photos',compact('photo'));
    }

    public function add_photo(){
        return view('backend.gallery.create');
    }


    public function store_photo(Request $request){
        $data = array();
        $data['title'] = $request->title;
        $data['type'] = $request->type;
        
        $image = $request->photo;
            if ($image) {
                $image_one = uniqid().'.'.$image->getClientOriginalExtension(); 
                Image::make($image)->resize(500,300)->save('image/photogallery/'.$image_one);
                $data['photo'] = 'image/photogallery/'.$image_one;
                // image/postimg/343434.png
                DB::table('photos')->insert($data);
 
                $notification = array(
              'message' => 'Photo Added Successfully',
              'alert-type' => 'success'
          );
 
          return Redirect()->route('photo.gallery')->with($notification);
            
            }else{
                return Redirect()->back();
            } // End Condition
 
 
   }  // END Method 

   public function edit_photo($id){

    $photo = DB::table('photos')->where('id',$id)->first();
    return view('backend.gallery.edit',compact('photo'));

    }

public function update_photo(Request $request, $id){
     
    $data = array();
      $data['title'] = $request->title;
      $data['type'] = $request->type;

      $oldimage = $request->oldimage;
  	  $image = $request->photo;
        
  	 	if ($image) {
  	 		$image_one = uniqid().'.'.$image->getClientOriginalExtension(); 
  	 		Image::make($image)->resize(500,300)->save('image/photogallery/'.$image_one);
  	 		$data['photo'] = 'image/photogallery/'.$image_one;
  	 		// image/postimg/343434.png
  	 		DB::table('photos')->where('id',$id)->update($data);
  	 		unlink($oldimage);

  	 		$notification = array(
    	 	'message' => 'Photo Updated Successfully',
    	 	'alert-type' => 'success'
    	 );

    	 return Redirect()->route('photo.gallery')->with($notification);
  	 	
  	 	}else{
  	 		$data['photo'] = $oldimage;
  	 		DB::table('photos')->where('id',$id)->update($data);
  	 		 
  	 		$notification = array(
    	 	'message' => 'Photo Updated Successfully',
    	 	'alert-type' => 'success'
    	 );
         return Redirect()->route('photo.gallery')->with($notification);
  	 	} // End Condition
  }  // End Method


  public function delete_photo($id){
    $photo = DB::table('photos')->where('id',$id)->first();
    unlink($photo->photo);

    DB::table('photos')->where('id',$id)->delete();

    $notification = array(
            'message' => 'Photo Deleted Successfully',
            'alert-type' => 'error'
        );

        return Redirect()->route('photo.gallery')->with($notification);
}

//  Video Gallery

public function video_gallery(){
    $video = DB::table('videos')->orderBy('id',('desc'))->paginate(5);
    return view('backend.gallery.videos',compact('video'));
}

public function add_video(){
    return view('backend.gallery.create_video');
}


public function store_video(Request $request){
    $data = array();
    $data['title'] = $request->title;
    $data['embed_code'] = $request->embed_code;
    $data['type'] = $request->type;
    
    
    DB::table('videos')->insert($data);

            $notification = array(
          'message' => 'Video Added Successfully',
          'alert-type' => 'success'
      );

      return Redirect()->route('video.gallery')->with($notification);

}  

public function edit_video($id){

$video = DB::table('videos')->where('id',$id)->first();
return view('backend.gallery.edit_video',compact('video'));

}

public function update_video(Request $request, $id){
 
$data = array();
  $data['title'] = $request->title;
  $data['embed_code'] = $request->embed_code;
  $data['type'] = $request->type;

           DB::table('videos')->where('id',$id)->update($data);

           $notification = array(
         'message' => 'Video Updated Successfully',
         'alert-type' => 'success'
     );

     return Redirect()->route('video.gallery')->with($notification);     
} 


public function delete_video($id){
$video = DB::table('videos')->where('id',$id)->first();

DB::table('videos')->where('id',$id)->delete();

$notification = array(
        'message' => 'Video Deleted Successfully',
        'alert-type' => 'error'
    );

    return Redirect()->route('video.gallery')->with($notification);
    }

}
