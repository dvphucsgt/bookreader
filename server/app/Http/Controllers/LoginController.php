<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
class LoginController extends Controller
{
    //
    
    public function getLogin(){
        if(Auth::check()){
            return redirect('sai-gon-tech/home');
        }
        else{
            return view('login');
        }
    }
    
    public function postLogin(Request $request){
        $this->validate($request, 
                [
                    'username'=>'required',
                    'password'=>'required|min:6|max:40'
                ],
                [
                    'username.required'=>'Please input your username.!',
                    'password.required'=>'Please input your password.!',
                    'password.min'=>'Password not less than 6 characters.!',
                    'password.max'=>'Password not more than 40 characters.!'
                ]);
        
        if(Auth::attempt(['loginName'=>$request->username,'password' => $request->password])){
            return redirect('sai-gon-tech/home');
        }
        else{
            return redirect('login')->with('thongbao', 'Login Failed');
        }
    }
    
    public function getLogout(){
        Auth::logout();
        return redirect('login');
    }
}
