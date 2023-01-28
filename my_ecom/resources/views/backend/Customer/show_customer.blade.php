@extends('backend/admin/layout')
@section('page_title','Customer Details')
@section('customer_select','active')
@section('container')
<h2 class="text-center">Customer Details</h2>
<a href="{{url('admin/customers')}}" class="btn btn-danger mt-4">X</a>

<div class="table-responsive m-b-40">
<table class="table table-borderless table-data3">
    <thead>
        
    </thead>
    <tbody>
       <tr>
        <td><b>Name<b></td>
        <td>{{$customer_list->name}}</td>
       </tr>
       <tr>
        <td><b>Email</b></td>
        <td>{{$customer_list->email}}</td>
       </tr>
       <tr>
        <td><b>Phone</b></td>
        <td>{{$customer_list->phone}}</td>
       </tr>
       <tr>
        <td><b>Address</b></td>
        <td>{{$customer_list->address}}</td>
       </tr>
       <tr>
        <td><b>City</b></td>
        <td>{{$customer_list->city}}</td>
       </tr>
       <tr>
        <td><b>State</b></td>
        <td>{{$customer_list->state}}</td>
       </tr>
       <tr>
        <td><b>Zip</b></td>
        <td>{{$customer_list->zip}}</td>
       </tr>
       <tr>
        <td><b>Company</b></td>
        <td>{{$customer_list->company}}</td>
       </tr>
       <tr>
        <td><b>Gstin</b></td>
        <td>{{$customer_list->gstin}}</td>
       </tr>
       <tr>
        <td><b>Added on</b></td>
        <td>{{$customer_list->created_at}}</td>
       </tr>
       <tr>
        <td><b>Updated on</b></td>
        <td>{{$customer_list->updated_at}}</td>
       </tr>
    </tbody>
</table>
</div>
@endsection