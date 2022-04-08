<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class SettingController extends Controller
{
    public function index(){
        $social = DB::table('socials')->first();
        return view('backend.setting.social',compact('social'));
    }

    public function social_update(Request $request,$id){

        $data = array();
             $data['facebook'] = $request->facebook;
             $data['twitter'] = $request->twitter;
             $data['youtube'] = $request->youtube;
             $data['linkedin'] = $request->linkedin;
             $data['instagram'] = $request->instagram;
             
             DB::table('socials')->where('id',$id)->update($data);

             $note = array(
                 'message' =>'Social Links Updated successfully',
                 'alert-type' => 'success'


             );
    
         return Redirect()->route('social.setting')->with($note);

    }

    public function seo_setting(){
        $seo = DB::table('seos')->first();
        return view('backend.setting.seo',compact('seo'));
    }

    public function seo_update(Request $request,$id){

        $data = array();
             $data['meta_author'] = $request->meta_author;
             $data['meta_title'] = $request->meta_title;
             $data['meta_keyword'] = $request->meta_keyword;
             $data['meta_description'] = $request->meta_description;
             $data['google_verification'] = $request->google_verification;
             $data['bing_verification'] = $request->bing_verification;
             $data['google_analytics'] = $request->google_analytics;
             $data['alexa_analytics'] = $request->alexa_analytics;
             
             DB::table('seos')->where('id',$id)->update($data);

             $note = array(
                 'message' =>'SEO Setting Updated successfully',
                 'alert-type' => 'success'


             );
    
         return Redirect()->route('seo.setting')->with($note);

    }

    public function prayer_setting(){
        $prayer = DB::table('prayers')->first();
        return view('backend.setting.prayer',compact('prayer'));
    }
    public function prayer_update(Request $request,$id){

        $data = array();
             $data['fajor'] = $request->fajor;
             $data['johor'] = $request->johor;
             $data['asor'] = $request->asor;
             $data['magrib'] = $request->magrib;
             $data['easha'] = $request->easha;
             $data['jummah'] = $request->jummah;            
             DB::table('prayers')->where('id',$id)->update($data);

             $note = array(
                 'message' =>'Prayer Times Updated successfully',
                 'alert-type' => 'success'
             );
    
         return Redirect()->route('prayer.setting')->with($note);

    }

    public function livetv_setting(){
        $livetv = DB::table('livetvs')->first();
        return view('backend.setting.livetv',compact('livetv'));
    }

    public function livetv_update(Request $request,$id){

        $data = array();
             $data['embed_code'] = $request->embed_code;
                        
             DB::table('livetvs')->where('id',$id)->update($data);

             $note = array(
                 'message' =>'Live Tv Updated successfully',
                 'alert-type' => 'success'


             );
    
         return Redirect()->route('livetv.setting')->with($note);


    }
    public function livetv_active(Request $request , $id){
        DB::table('livetvs')->where('id',$id)->update(['status'=>1]);
        $note = array(
            'message' =>'Live Tv Active successfully',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($note);
    }

    public function livetv_deactive(Request $request , $id){
        DB::table('livetvs')->where('id',$id)->update(['status'=>0]);
        $note = array(
            'message' =>'Live Tv Deactive successfully',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($note);
    }
    



}

