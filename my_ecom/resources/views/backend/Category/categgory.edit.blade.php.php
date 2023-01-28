@extends('admin/layout')
@section('container')
<h2 class="text-center">Category Manage</h2>
<a href="{{url('admin/category')}}" class="btn btn-danger mt-4">X</a>
<div class="card">
   <div class="card-header">Category Add</div>
   <div class="card-body">
      <div class="card-title">
      </div>
      <form action="{{route('category.insert')}}" method="post">
         @csrf
         <div class="form-group">
            <label for="category_name" class="control-label mb-1">Category Name</label>
            <input id="category_name" name="category_name" value="{{$category_name}}" type="tel" class="form-control">
            @error('category_name')
            <div class="alert alert-danger">
               {{$message}}
            </div>
            @enderror
         </div>
         <div class="form-group">
            <label for="category_slug" class="control-label mb-1">Category Slug</label>
            <input id="category_slug" name="category_slug" value="{{$category_slug}}" type="tel" class="form-control">
            @error('category_slug')
            <div class="alert alert-danger">
               {{$message}}
            </div>
            @enderror
         </div>
         <div>
            <button id="button" type="submit" class="btn btn-lg btn-info btn-block">
            Submit
            </button>
         </div>
      </form>
   </div>
</div>
@endsection