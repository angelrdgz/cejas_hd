<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Client;
use App\Branch;

use Auth;

class ClientController extends Controller
{
    public function index()
    {
        switch (Auth::user()->role_id) {
            case 1:
                $clients = Client::all();
        $branches = Branch::all();
                break;
            default:
            $clients = Client::where('branch_id', Auth::user()->branch_id)->get();
            $branches = [];
                break;
        }
        
        
        return view('clients.index', [
            'clients'=>$clients,
            'branches'=>$branches
        ]);
    }

    public function store(Request $request)
    {
        $client = new Client();
        $client->name = $request->name;
        $client->phone = $request->phone;
        $client->email = $request->email;
        $client->birthday = $request->birthday;
        $client->genere = $request->genere;
        $client->branch_id = $request->branch;
        $client->save();

        return redirect()->back()->with('message-success', 'Cliente creado correctamente');  
        
    }

    public function show($id)
    {
        $client = Client::find($id);
        return response()->json(['data'=>$client]);        
    }

    public function update(Request $request)
    {
        $client = Client::find($request->id);
        $client->name = $request->name;
        $client->phone = $request->phone;
        $client->email = $request->email;
        $client->birthday = $request->birthday;
        $client->genere = $request->genere;
        $client->branch_id = $request->branch;
        $client->save();

        return redirect()->back()->with('message-success', 'Cliente modificado correctamente');  

    }

       
}
