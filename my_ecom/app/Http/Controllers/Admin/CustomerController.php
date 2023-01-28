<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Admin\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Customer::all();
        return view('backend.Customer.customer',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request ,$id='')
    {
            $arr=Customer::where(['id'=>$id])->get();
            $result['customer_list']=$arr['0'];
            return view('backend.Customer.show_customer',$result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */

  

     public function status(Request $request,$status,$id)
     {
         $model= Customer::find($id);
         $model->status=$status;
         $model->save();
         $request->session()->flash('message','Customer Status Updated !');
         return redirect('admin/customers');
    }
 

}
