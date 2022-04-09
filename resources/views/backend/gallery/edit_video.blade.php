@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
            <div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card corona-gradient-card">
                  <div class="card-body py-0 px-0 px-sm-3">
                    <div class="row align-items-center">
                      <div class="col-4 col-sm-3 col-xl-2">
                        <img src="{{asset('backend/assets/images/dashboard/Group126@2x.png')}}" class="gradient-corona-img img-fluid" alt="">
                      </div>
                      <div class="col-5 col-sm-7 col-xl-8 p-0">
                        <h4 class="mb-1 mb-sm-0">Welcome to Easy News </h4>
                        
                      </div>
                      <div class="col-3 col-sm-2 col-xl-2 pl-0 text-center">
                        <span>
        <a href=" {{ url('/') }} " target="_blank" class="btn btn-outline-light btn-rounded get-started-btn">Vist Fontend ? </a>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

 

<div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit Video</h4>
                    
 <form method="POST" class="forms-sample" action="{{route('update.video',$video->id)}}" enctype="multipart/form-data">
  @csrf


    <div class="form-group">
      <label for="exampleInputName1">Video Title</label>
      <input type="text" class="form-control" id="exampleInputName1" name="title" value="{{ $video->title }}">
    </div>
    <div class="form-group">
      <label for="exampleTextarea1">Video Embed Code</label>
     <textarea class="form-control" name="embed_code" id="summernote">
      {{ $video->embed_code }}
     </textarea>
    </div>

    <div class="form-group col-md-6">
      <label for="exampleInputName1">video Type</label>
       <select class="form-control" id="exampleSelectGender" name="type">
   <option disabled="" selected="">--Select video Type--</option>
   <option value="1">Big video</option>
   <option value="0">Small video</option>
 
     </select>
    </div>

<br><br>
 
    <button type="submit" class="btn btn-primary mr-2">Update</button>
                     
                    </form>
                  </div>
                </div>
              </div>






@endsection