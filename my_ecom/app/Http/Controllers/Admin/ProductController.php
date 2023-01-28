<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Admin\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $data = Product::all();
        return view('backend.Product.product',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_product(Request $request ,$id='')
    {
        if($id>0){
            $arr=Product::where(['id'=>$id])->get();
            $result['name']=$arr['0']->name;
            $result['slug']=$arr['0']->slug;
            $result['image']=$arr['0']->image; 
            $result['category_id']=$arr['0']->category_id; 
            $result['brand']=$arr['0']->brand; 
            $result['model']=$arr['0']->model; 
            $result['shot_decs']=$arr['0']->shot_decs; 
            $result['desc']=$arr['0']->desc; 
            $result['keywords']=$arr['0']->keywords; 
            $result['technical_sepcification']=$arr['0']->technical_sepcification; 
            $result['uses']=$arr['0']->uses; 
            $result['warranty']=$arr['0']->warranty;
            $result['lead_time']=$arr['0']->lead_time;
            $result['tax_id']=$arr['0']->tax_id;
            $result['is_promo']=$arr['0']->is_promo;
            $result['is_featured']=$arr['0']->is_featured;
            $result['is_discounted']=$arr['0']->is_discounted;
            $result['is_tranding']=$arr['0']->is_tranding;
            $result['status']=$arr['0']->status;
            $result['id']=$arr['0']->id;
             
            $result['productAttrArr']=DB::table('products_attr')->where(['product_id'=>$id])->get();
             
            $productImagesArr=DB::table('product_images')->where(['product_id'=>$id])->get();
            if(!isset($productImagesArr[0])){
               $result['productImagesArr']['0']['id']='';
               $result['productImagesArr']['0']['images']='';
            }else{
                 $result['productImagesArr']=$productImagesArr;
            } 
              
           // $result['productImagesArr'] = DB::table('product_images')->where(['product_id'=>$id])->get();


           
         }else{
             $result['name']='';
             $result['slug']='';
             $result['image']='';
             $result['category_id']='';
             $result['brand']='';
             $result['model']='';
             $result['shot_decs']='';
             $result['desc']='';
             $result['keywords']='';
             $result['technical_sepcification']='';
             $result['uses']='';
             $result['warranty']='';
             $result['lead_time']='';
             $result['tax_id']='';
             $result['is_promo']='';
             $result['is_featured']='';
             $result['is_discounted']='';
             $result['is_tranding']='';

             $result['status']='';
             $result['id']=0;
            //  productAttrArr
            $result['productAttrArr'][0]['id']='';
            $result['productAttrArr'][0]['product_id']='';
            $result['productAttrArr'][0]['sku']='';
            $result['productAttrArr'][0]['attr_image']='';
            $result['productAttrArr'][0]['mrp']='';
            $result['productAttrArr'][0]['price']='';
            $result['productAttrArr'][0]['qty']='';
            $result['productAttrArr'][0]['size_id']='';
            $result['productAttrArr'][0]['color_id']='';

            $result['productImagesArr']['0']['id']='';
            $result['productImagesArr']['0']['images']='';
         }
         
        $result['category']=DB::table('categories')->where(['status'=>1])->get();

        $result['sizes']=DB::table('sizes')->where(['status'=>1])->get();
         
        $result['colors']=DB::table('colors')->where(['status'=>1])->get();
         
        $result['brands']=DB::table('brands')->where(['status'=>1])->get();

        $result['taxes']=DB::table('taxes')->where(['status'=>1])->get();


        return view('backend.Product.manage_product',$result);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function manage_product_process(Request $request)
    {
      //  echo '<pre>';
      //  print_r($request->post());
      //  die(); 
       if($request->post('id')){
           $image_validation = "mimes:jpeg,jpg,png";
       }else{
        $image_validation = "required|mimes:jpeg,jpg,png";
      }
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:products,slug,'.$request->post('id'),
            'image' =>  $image_validation,
            $request->post('id'),
            'attr_image.*' =>'required|mimes:jpeg,jpg,png',
            'images.*' =>'required|mimes:jpeg,jpg,png',

          ]);

          $paidArr=$request->post('paid');
          $skuArr=$request->post('sku');
          $product_idArr=$request->post('product_id');
          $attr_imageArr=$request->post('attr_image');
          $mrpArr=$request->post('mrp');
          $priceArr=$request->post('price');
          $qtyArr=$request->post('qty');
          $size_idArr=$request->post('size_id');
          $color_idArr=$request->post('color_id');
          foreach($skuArr as $key=>$val){
            $check=DB::table('products_attr')
            ->where('sku','=',$skuArr[$key])
            ->where('id','!=',$paidArr[$key])
            ->get();

            if(isset($check[0])){
               $request->session()->flash('sku_error',$skuArr[$key]. 'SKU already Used');
               return redirect(request()->headers->get('referer'));
            }
          }

          if($request->post('id')>0){
            $model=Product::find($request->post('id'));
            $msg = 'Product Updated !';

          }else{
            $model=new Product();
            $msg = 'Product Inserted !';
          }
          if($request->hasfile('image')){
            if($request->post('id')>0){
            $arrImage=DB::table('products')->where(['id'=>$request->post('id')])->get();
              if(Storage::exists('/public/media/'.$arrImage[0]->image))
              {
               Storage::delete('/public/media/'.$arrImage[0]->image);
              }
            }
            $image=$request->file('image');
            $ext=$image->extension();
            $image_name=time().'.'.$ext;
            $image->storeAs('/public/media',$image_name);
            $model->image=$image_name;
          }

          $model->name=$request->post('name');
          $model->slug=$request->post('slug');
          $model->category_id=$request->post('category_id');
          $model->brand=$request->post('brand');
          $model->model=$request->post('model');
          $model->shot_decs=$request->post('shot_decs');
          $model->desc=$request->post('desc');
          $model->keywords=$request->post('keywords');
          $model->technical_sepcification=$request->post('technical_sepcification');
          $model->uses=$request->post('uses');
          $model->warranty=$request->post('warranty');
          $model->lead_time=$request->post('lead_time');
          $model->tax_id=$request->post('tax_id');
          $model->is_promo=$request->post('is_promo');
          $model->is_featured=$request->post('is_featured');
          $model->is_discounted=$request->post('is_discounted');
          $model->is_tranding=$request->post('is_tranding');

          $model->status=1;
          $model->save();
          $pid=$model->id;
           /* Product Attr start*/
           foreach($skuArr as $key=>$val){
              $productAttrarr=[]; 
               $productAttrarr['product_id']=$pid;
               $productAttrarr['sku']=$skuArr[$key];
               $productAttrarr['mrp']=(int)$mrpArr[$key];
               $productAttrarr['price']=(int)$priceArr[$key]; 
               $productAttrarr['qty']=(int)$qtyArr[$key]; 
               if($size_idArr[$key]==''){
                $productAttrarr['size_id']=0; 
               }else{
                $productAttrarr['size_id']=$size_idArr[$key]; 
               }
              if($color_idArr[$key]==''){
                $productAttrarr['color_id']=0;
              }else{
               $productAttrarr['color_id']=$color_idArr[$key];
              } 
              if($request->hasfile("attr_image.$key")){
                if($paidArr[$key]!=''){
                   $arrImage=DB::table('products_attr')->where(['id'=>$paidArr[$key]])->get();
                   if(Storage::exists('/public/media/'.$arrImage[0]->attr_image))
                 {
                    Storage::delete('/public/media/'.$arrImage[0]->attr_image);
                }
              }
                 $rand = rand('111111111','99999999');
                 $attr_image=$request->file("attr_image.$key");
                 $ext=$attr_image->extension();
                 $image_name=$rand.'.'.$ext;
                 $request->file("attr_image.$key")->storeAs('/public/media',$image_name);
                 $productAttrarr['attr_image']=$image_name;
              }else{
                 $productAttrarr['attr_image']='';

              }

              if($paidArr[$key]!=''){
                DB::table('products_attr')->where(['id'=>$paidArr[$key]])->update($productAttrarr);
              }else{
                DB::table('products_attr')->insert($productAttrarr);
              }

           }
         /* product Attr End*/

         /* product Images start*/
          $piidArr=$request->post('piid');
          foreach($piidArr as $key=>$val){
            $productImageArr['product_id']=$pid;
            if($request->hasfile("images.$key")){
              if($piidArr[$key]!=''){
                $arrImage=DB::table('product_images')->where(['id'=>$piidArr[$key]])->get();
                if(Storage::exists('/public/media/'.$arrImage[0]->images))
              {
                 Storage::delete('/public/media/'.$arrImage[0]->images);
             }
           }
              $rand = rand('111111111','99999999');
              $images=$request->file("images.$key");
              $ext=$images->extension();
              $image_name=$rand.'.'.$ext;
              $request->file("images.$key")->storeAs('/public/media',$image_name);
              $productImageArr['images']=$image_name;
          }else{
            $productImageArr['attr_image']='';

          }

            if($piidArr[$key]!=''){
              DB::table('product_images')->where(['id'=>$piidArr[$key]])->update($productImageArr);
            }else{
              DB::table('product_images')->insert($productImageArr);
            }  

          }
         
         /* product Images End*/

           $request->session()->flash('message',$msg); 
          return redirect('admin/product');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request,$status,$id)
    {
      
        $model= Product::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','Product Status Updated !');
        return redirect('admin/product');
   }
     public function product_attr_delete(Request $request,$paid,$pid)
     {
      dd($request);
       die();
       
      $arrImage=DB::table('products_attr')->where(['id'=>$paid])->get();
      if(Storage::exists('/public/media/'.$arrImage[0]->attr_image))
      {
        Storage::delete('/public/media/'.$arrImage[0]->attr_image);
      }
        DB::table('products_attr')->where(['id'=>$paid])->delete();
         return redirect('admin/product/manage_product/'.$pid);
     }

     public function product_images_delete(Request $request,$paid,$pid)
     {
      dd($request);
      die();
        $arrImage=DB::table('product_images')->where(['id'=>$paid])->get();
        if(Storage::exists('/public/media/'.$arrImage[0]->images))
        {
          Storage::delete('/public/media/'.$arrImage[0]->images);
        }
        DB::table('product_images')->where(['id'=>$paid])->delete();
         return redirect('admin/product/manage_product/'.$pid);
     }

     public function delete(Request $request,$id)
      {
          $model= Product::find($id);
          $model->delete();
          $request->session()->flash('message','Product deleted');
          return redirect('admin/product');
     }
 
    
}
