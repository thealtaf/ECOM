@extends('backend/admin/layout')
s@section('page_title','Manage Size')
@section('size_select','active')
@section('container')
@if(session()->has('message'))
<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
{{session('message')}}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
</button>
</div>
@endif

<h2 class="text-center">Size Manage</h2>
<a href="{{url('admin/size')}}" class="btn btn-danger mt-4">X</a>
<div class="card">
    <div class="card-header">Size Add</div>
    <div class="card-body">
        <div class="card-title">
        </div>
        <form action="{{route('size.manage_size_process')}}" method="post">
            @csrf
        <div class="form-group">
                <label for="size" class="control-label mb-1">Size</label>
                <input id="size" name="size" value="{{$size}}" type="tel" class="form-control">
                @error('size')
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