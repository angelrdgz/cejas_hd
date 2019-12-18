<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;

use Auth;
use Mail;
use App\Engagement;

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
        $engagement = Engagement::find(1);        
        $days = ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'];
        Mail::send('emails.engagement',[
            'engagement'=>$engagement,
            'days'=>$days,
        ], function($message){
            $message->from('abc@gmail.com');
            $message->to('test@cloudways.com', 'Admin')->subject('Cloudways Feedback');
        });        
    }
}
