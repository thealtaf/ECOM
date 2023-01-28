<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Admin\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
     public function index()
     {
         $data = Color::all();
         return view('backend.backend.Color.color',compact('data'));
     }
 
     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function manage_color(Request $request ,$id='')
     {
         if($id>0){
             $arr=Color::where(['id'=>$id])->get();
             $result['color']=$arr['0']->color; 
             $result['id']=$arr['0']->id;       
       
          }else{
              $result['color']='';
              $result['id']=0;
 
         }
         return view('backend.Color.manage_color',$result);
     }
 
     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function manage_color_process(Request $request)
     {
         $request->validate([
            'color' => 'required|unique:colors,color,'.$request->post('id'),
 
           ]);
 
           if($request->post('id')>0){
             $model=Color::find($request->post('id'));
             $msg = 'Color Updated !';
 
           }else{
             $model=new Color();
             $msg = 'Color Inserted !';
           }
           $model->color=$request->post('color');
           
           $model->save();
            $request->session()->flash('message',$msg); 
            return redirect('admin/color');
     }
 
     /**
      * Display the specified resource.
      *
      * @param  \App\Models\Color  $color
      * @return \Illuminate\Http\Response
      */
 
      public function delete(Request $request,$id)
      {
          $model= Color::find($id);
          $model->delete();
          $request->session()->flash('message','Color deleted');
          return redirect('admin/color');
     }
 
     public function status(Request $request,$status,$id)
     {
       
         $model= Color::find($id);
         $model->status=$status;
         $model->save();
         $request->session()->flash('message','Color Status Updated !');
         return redirect('admin/color');
    }
 }
