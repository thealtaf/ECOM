@extends('backend/admin/layout')
@section('page_title','Manage Brand')
@section('brand_select','active')
@section('container')
<h2 class="text-center">Brand Manage</h2>
<a href="{{url('admin/brand')}}" class="btn btn-danger mt-4">X</a>
<div class="card">
   <div class="card-header">Brand Add</div>
   <div class="card-body">
      <div class="card-title">
      </div>
      <form action="{{route('brand.manage_brand_process')}}" method="post" 
       enctype="multipart/form-data">
         @csrf
         <div class="form-group">
            <label for="name" class="control-label mb-1">Brand</label>
            <input type="text" name="name" value="{{$name}}" type="tel" class="form-control">
            @error('name')
            <div class="alert alert-danger">
               {{$message}}
            </div>
            @enderror
         </div>

         @if($id>0)
         {{$image_required=""}}
         @else
         {{$image_required="required"}}
         @endif
            <div class="form-group">
               <div class="form-outline">
                  <input type="file" name="image" value="{{$image}}" class="form-control form-control-lg"  {{$image_required}}/>
                  <label class="form-label" for="warranty">Image</label>
                  @if($image!='')    
                 <img width="100px" class="ml-5 mt-3" src="{{asset('storage/media/model/'.$image)}}" />
               @endif
               </div>
               @error('image')
               <div class="alert alert-danger">
                  {{$message}}
               </div>
               @enderror
            </div>
            <div class="col-md-6 mb-4">
               <div class="form-outline">
               <label class="form-label" for="category_slug">Show in home Page</label>
               <input type="checkbox" id="is_home" name="is_home" {{$is_home_selected}}>
               </div>
             </div>
         </div> 
            <button id="button" type="submit" class="btn btn-lg btn-info btn-block">
            Submit
            </button>
         </div>
         <input type="hidden" name="id" value="{{$id}}"/>
      </form>
   </div>
</div>
@endsection