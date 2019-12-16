<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Branch;
use Auth;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::all();
        return view('branches.index', ['branches'=>$branches]);
    }

    public function store(Request $request)
    {

        $branch = new Branch();
        $branch->name = $request->name;
        $branch->schedule = $request->schedule;
        $branch->save();

        return redirect()->back()->with('message-success', 'Sucursal creada correctamente');  
        
    }

    public function show($id)
    {
        $branch = Branch::find($id);
        return response()->json(['data'=>$branch]);        
    }

    public function update(Request $request)
    {
        $branch = Branch::find($request->id);
        $branch->name = $request->name;
        $branch->schedule = $request->schedule;
        $branch->save();

        return redirect()->back()->with('message-success', 'Sucursal modificada correctamente');        
    }
}
