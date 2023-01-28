@extends('backend/admin/layout')
@section('page_title','Manage Coupon')
@section('coupon_select','active')
@section('container')
<h2 class="text-center">Coupon Manage</h2>
<a href="{{url('admin/coupon')}}" class="btn btn-danger mt-4">X</a>
<div class="card">
   <div class="card-header">Coupon Add</div>
   <div class="card-body">
      <div class="card-title">
      </div>
      <form action="{{route('coupon.manage_coupon_process')}}" method="post">
         @csrf
         <div class="row">
            <div class="col-md-6 mb-4">
               <div class="form-outline">
                  <input type="text" name="title" value="{{$title}}" class="form-control form-control"/>
                  <label class="form-label" for="title">Title</label>
               </div>
               @error('title')
               <div class="alert alert-danger">
                  {{$message}}
               </div>
               @enderror 
            </div>
            <div class="col-md-6 mb-4">
               <div class="form-outline">
                  <input type="text" name="code" value="{{$code}}" class="form-control form-control"/>
                  <label class="form-label" for="title">code</label>
               </div>
               @error('code')
               <div class="alert alert-danger">
                  {{$message}}
               </div>
               @enderror 
            </div>
         </div>
         <div class="row">
         <div class="col-md-6 mb-4">
               <div class="form-outline">
                  <input type="text" name="value" value="{{$value}}" class="form-control form-control" />
                  <label class="form-label" for="value">Value</label>
               </div>
               @error('value')
               <div class="alert alert-danger">
                  {{$message}}
               </div>
               @enderror
            </div>
            <div class="col-md-6 mb-4">
               <div class="form-outline">
               <select id="type" name="type"  type="tel" class="select form-control"required>
                @if($type=='value')
               <option value="value" selected>Value</option>
               <option value="per">Per</option>
               @elseif($type=='per')
               <option value="value" >Value</option>
               <option value="per" selected>Per</option>
               @else
               <option value="value" >Value</option>
               <option value="per" >Per</option>
                @endif
              </select>
               <label class="form-label" for="name">Type</label>
               </div>
               @error('type')
               <div class="alert alert-danger">
                  {{$message}}
               </div>
               @enderror
            </div>
         </div>
         <div>
         <div class="row">
         <div class="col-md-6 mb-4">
               <div class="form-outline">
               <select id="min_order_amt" name="min_order_amt"  type="tel" class="select form-control"required>
                @if($type=='1')
               <option value="1" selected>Yes</option>
               <option value="0">No</option>
               @else
               <option value="1" >Yes</option>
               <option value="0" selected>No</option>
                @endif
              </select>
               <label class="form-label" for="name">Min Order Amt</label>
               </div>
               @error('type')
               <div class="alert alert-danger">
                  {{$message}}
               </div>
               @enderror
            </div> 
            <div class="col-md-6 mb-4">
               <div class="form-outline">
               <select id="is_one_time" name="is_one_time"  type="tel" class="select form-control"required>
                @if($type=='1')
               <option value="1" selected>Yes</option>
               <option value="0">No</option>
               @else
               <option value="1" >Yes</option>
               <option value="0" selected>No</option>
                @endif
              </select>
               <label class="form-label" for="name">Is One Time</label>
               </div>
               @error('type')
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