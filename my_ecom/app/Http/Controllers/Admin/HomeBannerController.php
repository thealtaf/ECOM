<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Admin\HomeBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;
class HomeBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = HomeBanner::all();
        return view('backend.Home_banner.home_banner',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_home_banner(Request $request ,$id='')
    {
        if($id>0){
            $arr=HomeBanner::where(['id'=>$id])->get();
            $result['image']=$arr['0']->image;
            $result['btn_txt']=$arr['0']->btn_txt; 
            $result['btn_link']=$arr['0']->btn_link;             
            $result['id']=$arr['0']->id;
         }else{
             $result['image']='';
             $result['btn_txt']='';
             $result['btn_link']='';
             $result['id']=0;

        }
        return view('backend.Home_banner.manage_home_banner',$result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function manage_home_banner_process(Request $request)
    {
        if($request->post('id')){
            $image_validation = "mimes:jpeg,jpg,png";
        }else{
         $image_validation = "required|mimes:jpeg,jpg,png";
       }
        $request->validate([
            'image' =>  $image_validation,

          ]);

          if($request->post('id')>0){
            $model=HomeBanner::find($request->post('id'));
            $msg = 'Home_banner Updated !';

          }else{
            $model=new HomeBanner();
            $msg = 'Home_banner Inserted !';
          }

          if($request->hasfile('image')){
           if($request->post('id')>0){
            $arrImage=DB::table('home_banners')->where(['id'=>$request->post('id')])->get();
          if(Storage::exists('/public/media/banner/'.$arrImage[0]->image))
          {
             Storage::delete('/public/media/banner/'.$arrImage[0]->image);
          }
        }
            $image=$request->file('image');
            $ext=$image->extension();
            $image_name=time().'.'.$ext;
            $image->storeAs('/public/media/banner',$image_name);
            $model->image=$image_name;
          }
          $model->btn_txt=$request->post('btn_txt');
          $model->btn_link=$request->post('btn_link');
          $model->status=1;
          $model->save();
          $request->session()->flash('message',$msg); 
          return redirect('admin/home_banner');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HomeBanner  $home_banner
     * @return \Illuminate\Http\Response
     */

     public function delete(Request $request,$id)
     {
         $model= HomeBanner::find($id);
         $model->delete();
         $request->session()->flash('message','Home banner deleted');
         return redirect('admin/home_banner');
    }

    public function status(Request $request,$status,$id)
    {
      
        $model= HomeBanner::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','Home banner Status Updated !');
        return redirect('admin/home_banner');
   }

}
