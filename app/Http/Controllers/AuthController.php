<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(){
        return view('user.register');
    }
    public function handleregister(RegisterRequest $request){
        $user = new User;
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->save();
        Auth::login($user);
        return redirect(route('students.index'))->with('msg' , 'Welcome '.$user->name);
    }
    public function login(){
        return view('user.login');
    }
    public function handlelogin(LoginRequest $request){
        $is_login = Auth::attempt(['email' => $request->email , 'password'=>$request->password]);
        if(!$is_login){
            return redirect(route('login'))->with('msg' , 'invalid');
        }
        $user = User::where('email',$request->email)->first();
        return redirect(route('students.index'))->with('msg' , 'Welcome '.$user->name);
    }
    public function logout(){
        Auth::logout();
        return redirect(route('login'));
    }
}
