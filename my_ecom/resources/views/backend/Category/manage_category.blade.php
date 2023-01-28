@extends('backend/admin/layout')
@section('page_title','Manage Category')
@section('category_select','active')
@section('container')
<?php
if($id>0){
$category_image_required="";
}else{
$category_image_required="required";
}
?>
<h2 class="text-center">Category Manage</h2>
<a href="{{url('admin/category')}}" class="btn btn-danger mt-4">X</a>
<div class="card">
   <div class="card-header">Category Add</div>
   <div class="card-body">
      <div class="card-title">
      </div>
      <form action="{{route('category.manage_category_process')}}" method="post"  enctype="multipart/form-data">
         @csrf
         <div class="row">
            <div class="col-md-6 mb-4">
               <div class="form-outline">
                  <input type="text" name="category_name" value="{{$category_name}}" class="form-control form-control"/>
                  <label class="form-label" for="category_name">Category Name</label>
               </div>
               @error('category_name')
               <div class="alert alert-danger">
                  {{$message}}
               </div>
               @enderror 
            </div>
            <div class="col-md-6 mb-4">
               <div class="form-outline">
                  <input type="text" name="category_slug" value="{{$category_slug}}" class="form-control form-control"/>
                  <label class="form-label" for="category_slug">Category Slug</label>
               </div>
               @error('category_slug')
               <div class="alert alert-danger">
                  {{$message}}
               </div>
               @enderror 
            </div>
         </div>
         <div class="row">
                  <div class="col-md-6 mb-4">
               <div class="form-outline">
                  <input type="file" name="category_image" value="{{$category_image}}" class="form-control form-control"{{$category_image_required}}/>
                  <label class="form-label" for="category_image">Image</label>
                  @if($category_image!='')    
                    <img width="100px" src="{{asset('storage/media/category/'.$category_image)}}" />
                  @endif
               </div>
               @error('category_image')
               <div class="alert alert-danger">
                  {{$message}}
               </div>
               @enderror 
            </div>
            <div class="col-md-6 mb-4">
               <div class="form-outline">
               <select id="parent_category_id" name="parent_category_id"  type="tel"  class="form-control form-control">
                  <option value="0">Select Category</option>
                  @foreach($category as $list)
                  @if($parent_category_id==$list->id)
                  <option  selected value="{{$list->id}}">{{$list->category_name}}</option>
                  @else
                  <option  value="{{$list->id}}">{{$list->category_name}}</option>
                  @endif  
                  @endforeach
               </select>
               <label class="form-label" for="category_slug">Parent Category</label>
               </div>
            </div>
            <div class="col-md-6 mb-4">
               <div class="form-outline">
               <label class="form-label" for="category_slug">Show in home Page</label>
               <input type="checkbox" id="is_home" name="is_home" {{$is_home_selected}}>
               </div>
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