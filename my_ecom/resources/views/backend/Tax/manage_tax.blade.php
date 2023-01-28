@extends('backend/admin/layout')
@section('page_title','Manage Tax')
@section('tax_select','active')
@section('container')
@if(session()->has('message'))
<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
{{session('message')}}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
</button>
</div>
@endif

<h2 class="text-center">Tax Manage</h2>
<a href="{{url('admin/tax')}}" class="btn btn-danger mt-4">X</a>
<div class="card">
    <div class="card-header">Tax Add</div>
    <div class="card-body">
        <div class="card-title">
        </div>
        <form action="{{route('tax.manage_tax_process')}}" method="post">
            @csrf
        <div class="form-group">
                <label for="tax_desc" class="control-label mb-1">Tax desc</label>
                <input id="tax_desc" name="tax_desc" value="{{$tax_desc}}" type="tel" class="form-control">
                @error('tax_desc')
                <div class="alert alert-danger">
                {{$message}}
               </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="tax_value" class="control-label mb-1">Tax desc</label>
                <input id="tax_value" name="tax_value" value="{{$tax_value}}" type="tel" class="form-control">
                @error('tax_value')
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