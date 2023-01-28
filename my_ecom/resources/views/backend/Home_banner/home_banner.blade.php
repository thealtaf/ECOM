@extends('backend/admin/layout')
@section('page_title','Home Banner')
@section('home_banner_select','active')
@section('container')
@if(session()->has('message'))
<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
   {{session('message')}}
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
   <span aria-hidden="true">&times;</span>
   </button>
</div>
@endif
<h2 class="text-center">Home Banner</h2>
<a href="home_banner/manage_home_banner" class="btn btn-success mt-2" style="margin-left: 90%;">New Add</a>
<div class="table-responsive m-b-40">
   <table class="table table-borderless table-data3">
      <thead class="text-center">
         <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Btn Txt</th>
            <th>Btn Link</th>
            <th>Status</th>
            <th>Actoin</th>
         </tr>
      </thead>
      <tbody class="text-center">
         @foreach($data as $list)
         <tr>
            <td>{{$list->id}}</td>
            <th>
               @if($list->image!='')    
               <img width="70px" src="{{asset('storage/media/banner/'.$list->image)}}" />
               @endif
            </th>
            <td>{{$list->btn_txt}}</td>
            <td>{{$list->btn_link}}</td>
            <td>
               @if($list->status==1)
               <a href="{{url('admin/home_banner/status/0')}}/{{$list->id}}"  class="btn btn-success btn-sm">
               Active</a>
               @elseif($list->status==0)
               <a href="{{url('admin/home_banner/status/1')}}/{{$list->id}}" class="btn btn-danger btn-sm">
               Dective</a>
            </td>
            @endif
            <td>
               <a href="{{url('admin/home_banner/delete/')}}/{{$list->id}}" class="btn text-danger">
               <i  class="fa fa-trash ml-5" aria-hidden="true"></i></a>
               <a href="{{url('admin/home_banner/manage_home_banner/')}}/{{$list->id}}" class="btn text-info">
               <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            </td>
         </tr>
         @endforeach
      </tbody>
   </table>
</div>
@endsection