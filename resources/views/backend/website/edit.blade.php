@extends('admin.admin_master')
@section('admin')


<div class="content-wrapper">

    <div class="row">
        <div class="col-12 grid-margin stretch-card">
          <div class="card corona-gradient-card">
            <div class="card-body py-0 px-0 px-sm-3">
              <div class="row align-items-center">
                <div class="col-4 col-sm-3 col-xl-2">
                  <img src="{{ asset('backend')}}/assets/images/dashboard/Group126@2x.png" class="gradient-corona-img img-fluid" alt="">
                </div>
                <div class="col-5 col-sm-7 col-xl-8 p-0">
                  <h4 class="mb-1 mb-sm-0">Want even more features?</h4>
                  <p class="mb-0 font-weight-normal d-none d-sm-block">Check out our Pro version with 5 unique layouts!</p>
                </div>
                <div class="col-3 col-sm-2 col-xl-2 pl-0 text-center">
                  <span>
                    <a href="https://www.softacolor.com" target="_blank" class="btn btn-outline-light btn-rounded get-started-btn">Upgrade to PRO</a>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>


    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Update Website Links</h4>
          
          <form class="forms-sample" method="POST" action="{{ route('update.website',$website->id)}}">
            @csrf
            <div class="form-group">
              <label for="">Website Name</label>
              <input type="text" class="form-control" name="website_name" value="{{ $website->website_name}}">
              @error('website_name')
              <span class="text-danger">{{ $message}}</span>
              @enderror
            </div>
            <div class="form-group">
              <label for="">website Links</label>
              <input type="text" class="form-control" name="website_url" value="{{$website->website_url}}">
              @error('website_url')
              <span class="text-danger">{{ $message}}</span>
              @enderror
            </div>
            
            <button type="submit" class="btn btn-primary mr-2">Update</button>
          </form>
        </div>
      </div>
    </div>
    
@endsection