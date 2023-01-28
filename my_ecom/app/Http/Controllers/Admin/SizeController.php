<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Admin\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Size::all();
        return view('backend.Size.size',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_size(Request $request ,$id='')
    {
        if($id>0){
            $arr=Size::where(['id'=>$id])->get();
            $result['size']=$arr['0']->size; 
            $result['id']=$arr['0']->id;       
      
         }else{
             $result['size']='';
             $result['id']=0;

        }
        return view('backend.Size.manage_size',$result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function manage_size_process(Request $request)
    {
        $request->validate([
            'size' => 'required'

          ]);

          if($request->post('id')>0){
            $model=Size::find($request->post('id'));
            $msg = 'Size Updated !';

          }else{
            $model=new Size();
            $msg = 'Size Inserted !';
          }
          $model->size=$request->post('size');
          
          $model->save();
           $request->session()->flash('message',$msg); 
          return redirect('admin/size');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */

     public function delete(Request $request,$id)
     {
         $model= Size::find($id);
         $model->delete();
         $request->session()->flash('message','Size deleted');
         return redirect('admin/size');
    }

    public function status(Request $request,$status,$id)
    {
      
        $model= Size::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','Size Status Updated !');
        return redirect('admin/size');
   }
}
