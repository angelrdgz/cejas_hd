<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('services.index', ['services'=>$services]);
    }

    public function store(Request $request)
    {
        $service = new Service();
        $service->name = $request->name;
        $service->price = $request->price;
        $service->minutes = $request->minutes;
        $service->save();
        return redirect()->back()->with('message-success', 'Servicio creado correctamente');          
    }

    public function show($id)
    {
        $service = Service::find($id);
        return response()->json(['data'=>$service]);        
    }

    public function update(Request $request)
    {
        $service = Service::find($request->id);
        $service->name = $request->name;
        $service->price = $request->price;
        $service->minutes = $request->minutes;
        $service->save();

        return redirect()->back()->with('message-success', 'Servicio modificado correctamente');        
    }
}
