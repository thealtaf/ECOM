@extends('front/layout')
@section('page_title','Cart Page')
@section('container')
 <!-- catg header banner section -->
 
  <!-- / catg header banner section -->

 <!-- Cart view section -->
 <section id="cart-view">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="cart-view-area">
           <div class="cart-view-table">
             <form action="">
              @if(isset($list[0]))
               <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Image</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($list as $data)
                      <tr id="cart_box{{$data->attr_id}}">
                        <td><a class="remove" href="javascript:void(0)"onclick="deleteCartProduct('{{$data->pid}}','{{$data->size}}','{{$data->color}}',
                         '{{$data->attr_id}}')"><fa class="fa fa-close"></fa></a></td>
                        <td><a href="{{url('product/'.$data->slug)}}"><img src="{{asset('storage/media/'.$data->image)}}" alt="img"></a></td>
                        <td><a class="aa-cart-title" href="{{url('product/'.$data->slug)}}">{{$data->name}}</a>
                        <br> @if($data->size!='')
                            SIZE:{{$data->size}} 
                            @endif
                            <br> @if($data->color!='')
                            COLOR:{{$data->color}} 
                        @endif</td>
                        <td>Rs {{$data->price}}</td>
                        <td><input id="qty{{$data->attr_id}}" class="aa-cart-quantity" type="number" value="{{$data->qty}}"
                         onchange="updateQty('{{$data->pid}}','{{$data->size}}','{{$data->color}}',
                         '{{$data->attr_id}}','{{$data->price}}')"></td>
                        <td id="total_price_{{$data->attr_id}}">Rs {{$data->price * $data->qty}}</td>
                      </tr>
                      @endforeach
                      <tr>
                        <td colspan="6" class="aa-cart-view-bottom">
                          <!-- <div class="aa-cart-coupon">
                            <input class="aa-coupon-code" type="text" placeholder="Coupon">
                            <input class="aa-cart-view-btn" type="submit" value="Apply Coupon">
                          </div> -->
                          <input class="aa-cart-view-btn" type="button" value="Checkout">
                        </td>
                      </tr>
                      </tbody>
                  </table>
                </div>
                @else
                      <h3>Cart Empty</h3>
                @endif
             </form>            
           </div>
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- / Cart view section -->
 <input type="hidden" id="qty" value="1">
 <form action="" id="frmAddToCart">
     <input type="hidden" id="size_id" name="size_id"/>
     <input type="hidden" id="color_id" name="color_id"/>
     <input type="hidden" id="pqty" name="pqty"/>
     <input type="hidden" id="product_id" name="product_id"/>

     @csrf
  </form>
 

@endsection