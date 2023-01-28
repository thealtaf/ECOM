@extends('backend/admin/layout')
@section('page_title','Manage Product')
@section('product_select','active')
@section('container')
<?php
if($id>0){
$image_required="";
}else{
$image_required="required";
}
?>

@if(session()->has('message'))
<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
   {{session('message')}}
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
   <span aria-hidden="true">&times;</span>
   </button>
</div>
@endif
@if(session()->has('sku_error'))
<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
   {{session('sku_error')}}
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
   <span aria-hidden="true">&times;</span>
   </button>
</div>
@endif
@error('attr_image.*')
<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
   {{$message}}
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
   <span aria-hidden="true">&times;</span>
   </button>
</div>
@enderror
@error('images.*')
<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
   {{$message}}
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
   <span aria-hidden="true">&times;</span>
   </button>
</div>
@enderror
<h2 class="text-center">Product</h2>
<a href="{{url('admin/product')}}" class="btn btn-danger mt-4">X</a>
<div class="card">
   <div class="card-header">Product Add</div>
   <div class="card-body">
      <div class="card-title">
      </div>
      <form action="{{route('product.manage_product_process')}}" method="post"  enctype="multipart/form-data">
         @csrf
         <div class="row">
            <div class="col-md-4 mb-4">
               <div class="form-outline">
                  <input type="text" name="name" value="{{$name}}" class="form-control form-control-lg"/>
                  <label class="form-label" for="name">Name</label>
               </div>
               @error('name')
               <div class="alert alert-danger">
                  {{$message}}
               </div>
               @enderror 
            </div>
            <div class="col-md-4 mb-4">
               <div class="form-outline">
                  <input type="text" name="slug" value="{{$slug}}" class="form-control form-control-lg" />
                  <label class="form-label" for="slug">Slug</label>
               </div>
               @error('slug')
               <div class="alert alert-danger">
                  {{$message}}
               </div>
               @enderror
            </div>
            <div class="col-md-4 mb-4">
               <div class="form-outline datepicker w-100">
                  <input type="text" class="form-control form-control-lg" name="model" value="{{$model}}" required/>
                  <label for="model" class="form-label">Model</label>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-4 mb-4">
               <div class="form-outline">
                  <input type="text" name="uses" value="{{$uses}}" class="form-control form-control-lg" required/>
                  <label class="form-label" for="uses">Uses</label>
               </div>
            </div>
            <div class="col-md-4 mb-4">
               <div class="form-outline">
                  <input type="text" name="warranty" value="{{$warranty}}" class="form-control form-control-lg" required/>
                  <label class="form-label" for="warranty">warranty</label>
               </div>
            </div>
            <div class="col-md-4 mb-4">
               <div class="form-outline">
                  <input type="text" name="keywords" value="{{$keywords}}" class="form-control form-control-lg" required/>
                  <label class="form-label" for="keywords">Keywords</label>
               </div>
            </div>
         </div>
            <div class="row">
            <div class="col-md-6 mb-4">
               <div class="form-outline">
                  <input type="text" name="lead_time" value="{{$lead_time}}" class="form-control form-control-lg"/>
                  <label class="form-label" for="lead_time">Lead time</label>
               </div>
            </div>
            <div class="col-md-6 mb-4">
               <div class="form-outline">
            <select id="tax_id" name="tax_id"  type="tel" class="form-control form-control-lg">
                  <option value="">Select Tax</option>
                  @foreach($taxes as $list)
                  @if($tax_id==$list->id)
                  <option  selected value="{{$list->id}}">{{$list->tax_desc}}</option>
                  @else
                  <option  value="{{$list->id}}">{{$list->tax_desc}}</option>
                  @endif  
                  @endforeach
               </select>
               <label class="form-label select-label">Category option</label>
            </div>
          </div>
         </div>

            <div class="col-md-12 mb-4 pb-2">
               <div class="form-outline">
                  <label><strong>Shot_decs :</strong></label>
                   <textarea class="ckeditor form-control" name="shot_decs"></textarea>
               </div>
            </div>
            <div class="col-md-12 mb-4 ">
               <div class="form-outline">
               <label><strong>esc :</strong></label>
                   <textarea class="ckeditor form-control" name="desc"></textarea>
               </div>
            </div>
            <div class="col-md-12 mb-4">
               <div class="form-outline">
                  <label><strong>Technical_sepcification :</strong></label>
                   <textarea class="ckeditor form-control" name="technical_sepcification"></textarea>
               </div>
             </div>
         <div class="row ml-2">
            <div class="col-md-4 mb-4">
               <select id="category_id" name="category_id"  type="tel" class="select form-control-lg">
                  <option value="">Select Category</option>
                  @foreach($category as $list)
                  @if($category_id==$list->id)
                  <option  selected value="{{$list->id}}">{{$list->category_name}}</option>
                  @else
                  <option  value="{{$list->id}}">{{$list->category_name}}</option>
                  @endif  
                  @endforeach
               </select>
               <label class="form-label select-label">Category option</label>
            </div>
            <div class="col-md-4 mb-4">
               <select id="brand" name="brand"  type="tel" class="select form-control-lg">
                  <option value="">Select Brand</option>
                  @foreach($brands as $list)
                  @if($brand==$list->id)
                  <option selected value="{{$list->id}}">{{$list->name}}</option>
                  @else
                  <option value="{{$list->id}}">{{$list->name}}</option>
                  @endif  
                  @endforeach
               </select>
               <label class="form-label select-label">Brand option</label>
            </div>
            <div class="col-md-4 mb-4">
               <div class="form-outline">
                  <input type="file" name="image" value="{{$image}}" class="form-control form-control-lg"  {{$image_required}}/>
                  <label class="form-label" for="warranty">Image</label>
               </div>
               @if($image!='')    
                  <img width="100px" src="{{asset('storage/media/'.$image)}}" />
               @endif

               @error('image')
               <div class="alert alert-danger">
                  {{$message}}
               </div>
               @enderror
            </div>
         </div>
         <div class="row">
            <div class="col-md-3 mb-4">
               <div class="form-outline">
               <select id="is_promo" name="is_promo"  type="tel" class="select form-control"required>
                @if($is_promo=='1')
               <option value="1" selected>Yes</option>
               <option value="0">No</option>
               @else
               <option value="1" >Yes</option>
               <option value="0" selected>No</option>
                @endif
              </select>
               <label class="form-label" for="name">Promo</label>
               </div>
            </div>
            <div class="col-md-3 mb-4">
               <div class="form-outline">
               <select id="is_featured" name="is_featured"  type="tel" class="select form-control"required>
                @if($is_featured=='1')
               <option value="1" selected>Yes</option>
               <option value="0">No</option>
               @else
               <option value="1" >Yes</option>
               <option value="0" selected>No</option>
                @endif
              </select>
              <label class="form-label" for="name">Featured</label>
               </div>
            </div>
            <div class="col-md-3 mb-4">
               <div class="form-outline datepicker w-100">
               <select id="is_discounted" name="is_discounted"  type="tel" class="select form-control"required>
                @if($is_discounted=='1')
               <option value="1" selected>Yes</option>
               <option value="0">No</option>
               @else
               <option value="1" >Yes</option>
               <option value="0" selected>No</option>
                @endif
              </select>
              <label class="form-label" for="name">Discounted</label>
               </div>
            </div>
            <div class="col-md-3 mb-4">
               <div class="form-outline datepicker w-100">
               <select id="is_tranding" name="is_tranding"  type="tel" class="select form-control"required>
                @if($is_tranding=='1')
               <option value="1" selected>Yes</option>
               <option value="0">No</option>
               @else
               <option value="1" >Yes</option>
               <option value="0" selected>No</option>
                @endif
              </select>
              <label class="form-label" for="name">Tranding</label>
               </div>
            </div>
         </div>
         
   </div>
   <input type="hidden" name="id" value="{{$id}}"/>
   <div class="mt-4 pt-2">
   </div>
</div>
</div>
<!-- Product Image -->
<h2 class="text-center mb-1">Product Images</h2>
<div class="col-lg-12">
<div class="card" >
<div class="card-body">
<div class="form-group">
<div class="row" id="product_images_box">
@php
$loop_count_num=1;
@endphp
@foreach($productImagesArr as $key=>$val)
@php
$loop_count_prev=$loop_count_num;
$pIArr=(array)$val;
@endphp
<input id="piid" type="hidden" name="piid[]" value="{{$pIArr['id']}}"/>
<div class="product_images_{{$loop_count_num++}} col-md-4 mt-3" >
<div class="form-outline">
<label class="form-label" for="images">Image</label>
<input type="file" id="images" name="images[]" value="{{$pIArr['images']}}" class="form-control form-control"/>
@if($pIArr['images']!='')    
<img width="100px" src="{{asset('storage/media/'.$pIArr['images'])}}" />
@endif
</div>
</div>
<div class="col-md-2 mt-5">
@if($loop_count_num==2)
<button type="button" class="btn btn-success btn-lg" onclick="add_image_more()">
<i class="fa fa-plus"></i>&nbsp;Add
</button>
@else
<a href="{{url('admin/product/product_images_delete/')}}/{{$pIArr['id']}}/{{$id}}">
<button type="button" class="btn btn-danger btn-lg">
<i class="fa fa-minus"></i>&nbsp;Remove
</button></a>
@endif
</div>
@endforeach
</div>
</div>
</div> 
</div> 
</div>

<!-- Product Attr -->
<h2 class="text-center">Product Attributes</h2>
<div class="col-lg-12" id="product_attr_box">
@php
$loop_count_num=1;
@endphp
@foreach($productAttrArr as $key=>$val)
@php
$loop_count_prev=$loop_count_num;
$pAArr=(array)$val;
@endphp
<input id="paid" type="hidden" name="paid[]" value="{{$pAArr['id']}}"/>
<div class="card" id="product_attr_{{$loop_count_num++}}">
<div class="card-body">
<div class="form-group">
<div class="row">
<div class="col-md-2">
<div class="form-outline">
<label class="form-label" for="sku">Sku</label>
<input type="text" name="sku[]" value="{{$pAArr['sku']}}" class="form-control form-control"  required/>
</div>
</div>
<div class="col-md-2">
<div class="form-outline">
<label class="form-label" for="mrp">MRP</label>
<input type="text" id="mrp" name="mrp[]" value="{{$pAArr['mrp']}}" class="form-control form-control" />
</div>
</div>
<div class="col-md-2">
<div class="form-outline">
<label class="form-label" for="price">Price</label>
<input type="text" id="price" name="price[]" value="{{$pAArr['price']}}" class="form-control form-control" />
</div>
</div>
<div class="col-md-3">
<label class="form-label select-label">Size</label>
<select id="size_id" name="size_id[]"  type="tel" class="form-control form-control">
<option value="">Select</option>
@foreach($sizes as $list)
@if($pAArr['size_id']==$list->id)
<option selected  value="{{$list->id}}">{{$list->size}}</option> 
@else
<option value="{{$list->id}}">{{$list->size}}</option> 
@endif
@endforeach
</select>
</div>
<div class="col-md-3">
<label class="form-label select-label">color option</label>
<select id="color_id" name="color_id[]"  type="tel" class="form-control form-control">
<option value="">Select</option>
@foreach($colors as $list)
@if($pAArr['color_id']==$list->id)
<option  selected value="{{$list->id}}">{{$list->color}}</option> 
@else
<option value="{{$list->id}}">{{$list->color}}</option> 
@endif
@endforeach
</select>
</div>
<div class="col-md-2 mt-3">
<div class="form-outline">
<label class="form-label" for="qty">Qty</label>
<input type="text" id="qty" name="qty[]" value="{{$pAArr['qty']}}" class="form-control form-control" required/>
</div>
</div>
<div class="col-md-4 mt-3">
<div class="form-outline">
<label class="form-label" for="attr_image">Image</label>
<input type="file" id="attr_image" name="attr_image[]" value="{{$pAArr['attr_image']}}" class="form-control form-control">
@if($pAArr['attr_image']!='')    
<img width="100px" src="{{asset('storage/media/'.$pAArr['attr_image'])}}" />
@endif
</div>
</div>
<div class="col-md-2 mt-5">
@if($loop_count_num==2)
<button type="button" class="btn btn-success btn-lg" onclick="add_more()">
<i class="fa fa-plus"></i>&nbsp;Add
</button>
@else
<a href="{{url('admin/product/product_attr_delete/')}}/{{$pAArr['id']}}/{{$id}}">
<button type="button" class="btn btn-danger btn-lg">
<i class="fa fa-minus"></i>&nbsp;Remove
</button></a>
@endif
</div>
</div>
</div>
</div> 
</div> 
@endforeach
</div>
<button id="button" type="submit" class="btn btn-lg btn-info btn-block">
Submit
</button>
</form>
<script>
   var loop_count=1;
   function add_more(){
      loop_count++; 
     var html='<input id="paid" type="hidden" name="paid[]"/><div class="card" id="product_attr_'+loop_count+'"><div class="card-body"><div class="form-group"><div class="row">'; 
   
     html+='<div class="col-md-2"> <label class="form-label mb-1" for="sku">Sku</label><input type="text" id="sku" name="sku[]" value="" class="form-control form-control"/></div>';
     
     html+='<div class="col-md-2"> <label class="form-label mb-1" for="mrp">MRP</label><input type="text" id="mrp" name="mrp[]" value="" class="form-control form-control"/></div>';
   
     html+='<div class="col-md-2"><label class="form-label mb-1" for="price">Price</label><input type="text" id="price" name="price[]" value="" class="form-control form-control"/></div>';
   
     var size_id_html=jQuery('#size_id').html(); 
     size_id_html = size_id_html.replace("selected","");
     html+='<div class="col-md-3"><label class="form-label mb-1" for="size_id">size_id</label><select id="size_id" name="size_id[]" class="form-control">'+size_id_html+'</select></div>';
     
     var color_id_html=jQuery('#color_id').html(); 
     color_id_html = color_id_html.replace("selected","");
     html+='<div class="col-md-3"><label class="form-label mb-1" for="color_id">color_id</label><select id="color_id" name="color_id[]" class="form-control">'+color_id_html+'</select></div>';
   
     html+='<div class="col-md-2"> <label class="form-label mb-1" for="qty">Qty</label><input type="text" id="qty" name="qty[]" value="" class="form-control form-control"/></div>';
   
     html+='<div class="col-md-4"> <label class="form-label mb-1" for="atte_image">Image</label><input type="file" id="atte_image" name="atte_image[]" value="" class="form-control form-control"/></div>';
     
     html+='<div class="col-md-2"><label for="atte_image" class="control-label mb-1">&nbsp;&nbsp;&nbsp;</label><button type="button" class="btn btn-danger btn-lg" onclick=remove_more("'+loop_count+'")><i class="fa fa-minus"></i>&nbsp;Remove</button></div>';
   
     jQuery('#product_attr_box').append(html)
   
     html+='</div></div></div></div>';
   }
    function remove_more(loop_count){
    jQuery('#product_attr_'+loop_count).remove();
    }
    var loop_image_count=1;
    function add_image_more(){
      loop_image_count++;
     var html='<input id="piid" type="hidden" name="piid[]" value=""/><div class="col-md-4 mt-3 product_images_'+loop_image_count+'"><label class="form-label mb-1" for="images">Images</label><input type="file" id="images" name="images[]" value="" class="form-control form-control"/></div>';
     
     html+='<div class="col-md-2 mt-2 product_images_'+loop_image_count+'"><label for="atte_image" class="control-label mb-1">&nbsp;&nbsp;&nbsp;</label><button type="button" class="btn btn-danger btn-lg" onclick=remove_image_more("'+loop_image_count+'")><i class="fa fa-minus"></i>&nbsp;Remove</button></div>';
     jQuery('#product_images_box').append(html)
   
    }
    function remove_image_more(loop_image_count){
      jQuery('.product_images_'+loop_image_count).remove();
    }
</script>
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });
</script>
@endsection
