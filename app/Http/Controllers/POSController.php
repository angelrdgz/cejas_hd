<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Engagement;

use PDF;

class POSController extends Controller
{
    public function index()
    {
        $engagements = Engagement::whereRaw('DATE(reservation) = "'.date('Y-m-d').'"')->where('status', 'Confirmada')->get();
        return view('pos.index',['engagements'=>$engagements]);
    }

    public function store(Request $request)
    {
        $engagement = Engagement::find($request->id);
        $engagement->payment_method = $request->method;
        $engagement->status = 'Pagada';
        $engagement->save();

        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'engagement' => $engagement,
            'pay' => $request->pay,
        ];
        $pdf = PDF::loadView('pdfs.ticket', $data);  
        return $pdf->download('ticket_'.$engagement->id.'.pdf');

        
    }
}
