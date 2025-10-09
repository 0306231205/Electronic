<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class AdminController extends Controller
{
    //
    public function LoadAdmin()
    {
        return view("admin.HomeAdmin");
    }
     public function loginPage(){
        return view('admin.loginAdmin');
    }
    public function login(AdminLoginRequest $request){


            $user=DB::table('users')->where('username', $request->username)->count();
            if($user==0){
                return redirect()->route('admin.login')->with('status',"Username k ton tai");
            }
            $password=DB::table('users')->where('password',$request->password)->where('username',$request->username)->count();
            if($password==0)
            {
                  return redirect()->route('admin.login')->with('status',"Password sai ");
            }
            session()->put('login',true);
            
            return redirect()->route('admin.index');
    }
}
