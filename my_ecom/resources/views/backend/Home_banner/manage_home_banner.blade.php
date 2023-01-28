@extends('backend/admin/layout')
@section('page_title','Manage Home Banner')
@section('home_banner_select','active')
@section('container')
<?php
if($id>0){
$image_required="";
}else{
$image_required="required";
}
?>
<h2 class="text-center">Home Banner Manage</h2>
<a href="{{url('admin/home_banner')}}" class="btn btn-danger mt-4">X</a>
<div class="card">
   <div class="card-header">Home banner Add</div>
   <div class="card-body">
      <div class="card-title">
      </div>
      <form action="{{route('home_banner.manage_home_banner_process')}}" method="post"  enctype="multipart/form-data">
         @csrf
         <div class="row">
            <div class="col-md-6 mb-4">
               <div class="form-outline">
                  <input type="text" name="btn_txt" value="{{$btn_txt}}" class="form-control form-control"/>
                  <label class="form-label" for="btn_txt">Btn txt</label>
               </div> 
            </div>
            <div class="col-md-6 mb-4">
               <div class="form-outline">
                  <input type="text" name="btn_link" value="{{$btn_link}}" class="form-control form-control"/>
                  <label class="form-label" for="btn_link">Btn Link</label>
               </div> 
            </div>
         </div>
         <div class="row">
                  <div class="col-md-6 mb-4">
               <div class="form-outline">
                  <input type="file" name="image" value="{{$image}}" class="form-control form-control"{{$image_required}}/>
                  <label class="form-label" for="image">Image</label>
                  @if($image!='')    
                    <img width="100px" src="{{asset('storage/media/banner/'.$image)}}" />
                  @endif
               </div>
               @error('image')
               <div class="alert alert-danger">
                  {{$message}}
               </div>
               @enderror 
            </div>
         </div>
          <div>
            <button id="button" type="submit" class="btn btn-lg btn-info btn-block">
            Submit
            </button>
         </div>
         <input type="hidden" name="id" value="{{$id}}"/>
      </form>
   </div>
</div>
@endsection