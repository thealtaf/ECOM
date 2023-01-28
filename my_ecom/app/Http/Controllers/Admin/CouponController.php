<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Admin\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Coupon::all();
        return view('backend.Coupon.coupon',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_coupon(Request $request ,$id='')
    {
        if($id>0){
            $arr=Coupon::where(['id'=>$id])->get();
            $result['title']=$arr['0']->title;
            $result['value']=$arr['0']->value;
            $result['code']=$arr['0']->code; 
            $result['type']=$arr['0']->type;  
            $result['min_order_amt']=$arr['0']->min_order_amt;  
            $result['is_one_time']=$arr['0']->is_one_time;   
            $result['id']=$arr['0']->id;       
      
         }else{
             $result['title']='';
             $result['value']='';
             $result['code']='';
             $result['type']='';
             $result['min_order_amt']='';
             $result['is_one_time']='';
             $result['id']=0;

        }
        return view('backend.Coupon.manage_coupon',$result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function manage_coupon_process(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'value' => 'required',
            'code' => 'required|unique:coupons,code,'.$request->post('id'),

          ]);

          if($request->post('id')>0){
            $model=Coupon::find($request->post('id'));
            $msg = 'Coupon Updated !';

          }else{
            $model=new Coupon();
            $msg = 'Coupon Inserted !';
          }
          $model->title=$request->post('title');
          $model->code=$request->post('code');
          $model->value=$request->post('value');
          $model->type=$request->post('type');
          $model->min_order_amt=$request->post('min_order_amt');
          $model->is_one_time=$request->post('is_one_time');
          $model->status=1;
          $model->save();
           $request->session()->flash('message',$msg); 
          return redirect('admin/coupon');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */

     public function delete(Request $request,$id)
     {
         $model= Coupon::find($id);
         $model->delete();
         $request->session()->flash('message','Coupon deleted');
         return redirect('admin/coupon');
    }

    public function status(Request $request,$status,$id)
    {
      
        $model= Coupon::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','Coupon Status Updated !');
        return redirect('admin/coupon');
   }

}
