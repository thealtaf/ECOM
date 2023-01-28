<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Admin\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;


class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Brand::all();
        return view('backend.Brand.brand',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_brand(Request $request ,$id='')
    {
        if($id>0){
            $arr=Brand::where(['id'=>$id])->get();
            $result['name']=$arr['0']->name;
            $result['image']=$arr['0']->image;
            $result['is_home']=$arr['0']->is_home;        
            $result['is_home']=$arr['0']->is_home;
            $result['is_home_selected']="";   
            if($arr['0']->is_home==1){
              $result['is_home_selected']="checked";  
            }
             $result['id']=$arr['0']->id;       
      
         }else{
             $result['name']='';
             $result['image']='';
             $result['is_home']='';
             $result['is_home_selected']="";   
             $result['status']='';
             $result['id']=0;

        }
        return view('backend.Brand.manage_brand',$result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function manage_brand_process(Request $request)
    {
        $request->validate([
           'name' => 'required|unique:brands,name,'.$request->post('id'),
           'image' =>  'mimes:jpeg,jpg,png',
          ]);

          if($request->post('id')>0){
            $model=Brand::find($request->post('id'));
            $msg = 'Brand Updated !';

          }else{
            $model=new Brand();
            $msg = 'Brand Inserted !';
          }
          if($request->hasfile('image')){
            if($request->post('id')>0){
              $arrImage=DB::table('brands')->where(['id'=>$request->post('id')])->get();
            if(Storage::exists('/public/media/model/'.$arrImage[0]->image))
            {
               Storage::delete('/public/media/model/'.$arrImage[0]->image);
            }
          }
            $image=$request->file('image');
            $ext=$image->extension();
            $image_name=time().'.'.$ext;
            $image->storeAs('/public/media/model',$image_name);
            $model->image=$image_name;
          }
          $model->name=$request->post('name');
          $model->is_home=0;
          if($request->post('is_home')!==null){
             $model->is_home=1;
           }
          $model->status=1;
          $model->save();
           $request->session()->flash('message',$msg); 
          return redirect('admin/brand');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */

     public function delete(Request $request,$id)
     {
         $model= Brand::find($id);
         $model->delete();
         $request->session()->flash('message','Brand deleted');
         return redirect('admin/brand');
    }

    public function status(Request $request,$status,$id)
    {
      
        $model= Brand::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','Brand Status Updated !');
        return redirect('admin/brand');
   }
}