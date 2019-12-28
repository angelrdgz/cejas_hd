<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Engagement;

class POSController extends Controller
{
    public function index()
    {
        $engagements = Engagement::whereRaw('DATE(reservation) = "'.date('Y-m-d').'"')->where('status', 'Confirmada')->get();
        return view('pos.index',['engagements'=>$engagements]);
    }
}
