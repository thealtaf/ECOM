@extends('backend/admin/layout')
@section('page_title','Customer')
@section('customer_select','active')
@section('container')
@if(session()->has('message'))
<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
{{session('message')}}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
</button>
</div>
@endif
<h2 class="text-center">Customer</h2>
<div class="table-responsive m-b-40">
<table class="table table-borderless table-data3">
    <thead class="text-center">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>City</th>
            <th>Status</th>
            <th>Actoin</th>
            
        </tr>
    </thead>
    <tbody class="text-center">
        @foreach($data as $list)
        <tr>
            <td>{{$list->id}}</td>
            <td>{{$list->name}}</td>
            <td>{{$list->email}}</td>
            <td>{{$list->phone}}</td>
            <td>{{$list->city}}</td>
            <td>
               @if($list->status==1)
               <a href="{{url('admin/customers/status/0')}}/{{$list->id}}"  class="btn btn-success btn-sm">
               Active</a>
               @elseif($list->status==0)
               <a href="{{url('admin/customers/status/1')}}/{{$list->id}}" class="btn btn-danger btn-sm">
               Dective</a>
            </td>
            @endif
            <td> 
                <a href="{{url('admin/customers/show/')}}/{{$list->id}}" class="btn text-info">
                <i class="fa fa-eye" aria-hidden="true"></i>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection