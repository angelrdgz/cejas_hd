<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Engagement;
use App\Service;
use App\Branch;
use App\User;
use App\Client;
use Auth;

use Mail;

class EngagementController extends Controller
{
    public function index()
    {
        switch (Auth::user()->role_id) {
            case 1:
                $engagements = Engagement::where('status', 'Confirmada')->get();
                $pendingEngagements = Engagement::where('status', 'Pendiente')->get();
                $advisors = User::where('role_id', 3)->get();
                $branches = Branch::all();
                $services = Service::all();
                $users  = User::all();
                $clients  = Client::all();
                break;
            default:
                $engagements = Engagement::where('branch_id', Auth::user()->branch_id)->where('status', 'Confirmada')->get();
                $pendingEngagements = Engagement::where('branch_id', Auth::user()->branch_id)->where('status', 'Pendiente')->get();
                $advisors = User::where('branch_id', Auth::user()->branch_id)->where('role_id', 3)->get();
                $branches = Branch::all();
                $services = Service::all();
                $users  = User::all();
                $clients  = Client::all();
                $engagements = Engagement::where('branch_id', Auth::user()->branch_id)->get();
                break;
        }


        return view('engagements.index', [
            'engagements' => $engagements,
            'pendingEngagements' => $pendingEngagements,
            'branches' => $branches,
            'services' => $services,
            'users' => $users,
            'clients' => $clients,
            'advisors' => $advisors
        ]);
    }

    public function store(Request $request)
    {

        $engagement = new Engagement();
        $engagement->service_id = $request->service;
        $engagement->client_id = $request->client;
        $engagement->adviser_id = 1;
        $engagement->branch_id = $request->branch;
        $engagement->user_id = Auth::user()->id;
        $engagement->status = 'Pendiente';
        $engagement->reservation = $request->reservation.' '.$request->hour;
        $engagement->notes = $request->notes;
        $engagement->save();

        $days = ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'];
        Mail::send('emails.engagement',[
            'engagement'=>$engagement,
            'days'=>$days,
        ], function($message) use($engagement) {
            $message->from('contacto@cejashd.com');
            $message->to($engagement->client->email, 'Cita - Cejas HD')->subject('Confirmación de Cita');
        });

        return redirect('admin/citas');
    }

    public function show($id)
    {
        $engagement = Engagement::find($id);
        $engagement->service;
        $engagement->branch;
        $engagement->adviser;
        $engagement->client;
        return response()->json(['data' => $engagement]);
    }

    public function update(Request $request, $id)
    {
        $engagement = Engagement::find($id);
        switch ($request->process) {
            case '2':
                $engagement->status = 'Confirmada';
                break;
            case '4':
                $engagement->status = 'Cancelada';
                break;

            default:
                # code...
                break;
        }
        $engagement->save();

        return redirect()->back();
    }
}
