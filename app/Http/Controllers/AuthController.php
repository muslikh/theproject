<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function index(){
        return view('auth.login');
     }

     public function register(){ 
        return view('auth.register'); 
     }

     public function proses_login(Request $request){

        
        $credentials =  $request->only('email','password');
        
        $validate = Validator::make($credentials,[
            'email'=>'required|email',
            'password'=>'required'
        ]);

        
        if($validate->fails()){
            
            return back()->withErrors($validate)->withInput();
        }

        
        if(Auth::attempt($credentials)){
            
            return redirect()->intended('dashboard')->with('success','Successfully Login');
        }
        
        return redirect('login')->withInput()->withErrors(['login_error'=>'Username or password are wrong!']);
      }

      public function dashboard(){ 
        
        if(Auth::check()){
            
            $totalUser = User::all()->count();
            $totalCompany = Company::all()->count();
            $totalEmployees = Employees::all()->count();
        
            return view('home',compact('totalUser','totalCompany','totalEmployees'));

        }

        return redirect('login')->with('You dont have access');
      }

      public function proses_register(Request $request){

        
        $validate = Validator::make($request->all(),[
            'fullname'=>'required',
            'email'=>'required|email',
            'password'=>'required',
            'password_confirm' => 'required|confirmed',
        ]);


         if($validate->fails()){
            return back()->withErrors($validate)->withInput();
        }

        User::create($request->all());

        return redirect('dashboard')->with('success','You have successfully register');


       }

       public function logout(){
        //  clear session dan memberitahu auth dengan status logout
            Session::flush();
            Auth::logout();

            return Redirect('login');
        }
}