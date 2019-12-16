<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Branch;

use Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $branches = Branch::all();
        return view('users.index', [
            'users'=>$users,
            'branches'=>$branches,
            'roles'=>['','administrador','supervisor','asesor']
        ]);
    }

    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role;
        $user->branch_id = $request->branch;
        $user->save();

        return redirect()->back()->with('message-success', 'Usuario creado correctamente');  
        
    }

    public function show($id)
    {
        $user = User::find($id);
        return response()->json(['data'=>$user]);        
    }

    public function update(Request $request)
    {
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password != ''){
            $user->password = Hash::make($request->password);
        }
        $user->role_id = $request->role;
        $user->branch_id = $request->branch;
        $user->save();

        return redirect()->back()->with('message-success', 'Usuario modificado correctamente');  

    }
}
