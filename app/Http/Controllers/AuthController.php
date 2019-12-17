<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;

use Auth;
use Mail;

class AuthController extends Controller
{

    public function login()
    {
        return view('auth.login');
    }

    public function loginPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect('/admin/calendario');
        }else{
            return back();
        }

        
    }

    public function logout(Request $request){
        Auth::logout();
        return redirect('/');
    }

    public function  email()
    {
        Mail::send('emails.engagement',[], function($message){
            $message->from('abc@gmail.com');
            $message->to('test@cloudways.com', 'Admin')->subject('Cloudways Feedback');
        });        
    }
}
