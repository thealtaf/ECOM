<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Admin\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;



class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Category::all();
        return view('backend.Category.category',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_category(Request $request ,$id='')
    {
        if($id>0){
            $arr=Category::where(['id'=>$id])->get();
            $result['category_name']=$arr['0']->category_name;
            $result['category_slug']=$arr['0']->category_slug; 
            $result['category_slug']=$arr['0']->category_slug; 
            $result['parent_category_id']=$arr['0']->parent_category_id; 
            $result['category_image']=$arr['0']->category_image;
            $result['is_home']=$arr['0']->is_home;
            $result['is_home_selected']="";   
            if($arr['0']->is_home==1){
              $result['is_home_selected']="checked";  
            } 
            $result['id']=$arr['0']->id;

          

         }else{
             $result['category_name']='';
             $result['category_slug']='';
             $result['parent_category_id']='';
             $result['category_image']='';
             $result['is_home']='';
             $result['is_home_selected']="";   
             $result['id']=0;

        }
        $result['category']=DB::table('categories')->where('id','!=',$id)->get();
        return view('backend.Category.manage_category',$result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function manage_category_process(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'category_slug' => 'required|unique:categories,category_slug,'.$request->post('id'),
            'category_image' => 'mimes:jpeg,jpg,png',

          ]);

          if($request->post('id')>0){
            $model=Category::find($request->post('id'));
            $msg = 'Category Updated !';

          }else{
            $model=new Category();
            $msg = 'Category Inserted !';
          }

          if($request->hasfile('category_image')){
           if($request->post('id')>0){
            $arrImage=DB::table('categories')->where(['id'=>$request->post('id')])->get();
          if(Storage::exists('/public/media/category/'.$arrImage[0]->category_image))
          {
             Storage::delete('/public/media/category/'.$arrImage[0]->category_image);
          }
        }
            $image=$request->file('category_image');
            $ext=$image->extension();
            $image_name=time().'.'.$ext;
            $image->storeAs('/public/media/category',$image_name);
            $model->category_image=$image_name;
          }
          $model->category_name=$request->post('category_name');
          $model->category_slug=$request->post('category_slug');
          $model->parent_category_id=$request->post('parent_category_id');
          $model->is_home=0;
           if($request->post('is_home')!==null){
              $model->is_home=1;
            }
          $model->status=1;
          $model->save();
          $request->session()->flash('message',$msg); 
          return redirect('admin/category');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */

     public function delete(Request $request,$id)
     {
         $model= Category::find($id);
         $model->delete();
         $request->session()->flash('message','category deleted');
         return redirect('admin/category');
    }

    public function status(Request $request,$status,$id)
    {
      
        $model= Category::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','Category Status Updated !');
        return redirect('admin/category');
   }

   
   }
