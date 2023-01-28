@extends('backend/admin/layout')
@section('page_title','Coupon')
@section('container')
@if(session()->has('message'))
<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
   {{session('message')}}
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
   <span aria-hidden="true">&times;</span>
   </button>
</div>
@endif
<h2 class="text-center">Coupon</h2>
<a href="coupon/manage_coupon" class="btn btn-success mt-2" style="margin-left: 90%;">New Add</a>
<div class="table-responsive m-b-40">
   <table class="table table-borderless table-data3">
      <thead class="text-center">
         <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Value</th>
            <th>Code</th>
            <th>Status</th>
            <th>Actoin</th>
         </tr>
      </thead>
      <tbody class="text-center">
         @foreach($data as $list)
         <tr>
            <td>{{$list->id}}</td>
            <td>{{$list->title}}</td>
            <td>{{$list->value}}</td>
            <td>{{$list->code}}</td>
            <td>
               @if($list->status==1)
               <a href="{{url('admin/coupon/status/0')}}/{{$list->id}}"  class="btn btn-success btn-sm">
               Active</a>
               @elseif($list->status==0)
               <a href="{{url('admin/coupon/status/1')}}/{{$list->id}}" class="btn btn-danger btn-sm">
               Dective</a>
            </td>
            @endif
            </td>
            <td>  
               <a href="{{url('admin/coupon/delete/')}}/{{$list->id}}" class="btn text-danger">
               <i  class="fa fa-trash ml-5" aria-hidden="true"></i></a>
               <a href="{{url('admin/coupon/manage_coupon/')}}/{{$list->id}}" class="btn text-info">
               <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            </td>
         </tr>
         @endforeach
      </tbody>
   </table>
</div>
@endsection