<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->session()->has('ADMIN_LOGIN')) {
            return redirect('admin/dashboard');       
        }else{
           return view('backend.admin.login');
        } 
        return view('backend.admin.login');
 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function auth(Request $request)
    {
        
        $email=$request->post('email');
        $password=$request->post('password');

         $result=Admin::where(['email'=>$email,'password'=>$password])->first();
       
        if($result){    
            if($request->post('password')){
                $request->session()->put('ADMIN_LOGIN',true);
                $request->session()->put('ADMIN_ID',$result->id);
                return redirect('admin/dashboard');
            }else{
                $request->session()->flash('error','Please enter correct password');
                return redirect('/admin'); 
            }
           
        }else{
            $request->session()->flash('error','Please enter valid login details');
            return redirect('/admin'); 
        }
    }

    public function dashboard()
    {
        return view('backend.admin.dashboard');
    }

}
