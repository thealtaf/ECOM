@extends('backend/admin/layout')
@section('page_title','Manage Color')
@section('color_select','active')
@section('container')
<h2 class="text-center">Color Manage</h2>
<a href="{{url('admin/color')}}" class="btn btn-danger mt-4">X</a>
<div class="card">
   <div class="card-header">Color Add</div>
   <div class="card-body">
      <div class="card-title">
      </div>
      <form action="{{route('color.manage_color_process')}}" method="post">
         @csrf
         <div class="form-group">
            <label for="color" class="control-label mb-1">Color</label>
            <input id="color" name="color" value="{{$color}}" type="tel" class="form-control">
            @error('color')
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
         <input type="hidden" name="id" value="{{$id}}"/>
      </form>
   </div>
</div>
@endsection