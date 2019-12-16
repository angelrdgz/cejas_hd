<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Engagement;

class DashboardController extends Controller
{
    public function index()
    {
        $engagements = Engagement::whereRaw('DATE(reservation) = "'.date('Y-m-d').'"')->orderBy('reservation','DESC')->get();
        $engagementsComplete = Engagement::whereRaw('DATE(reservation) = "'.date('Y-m-d').'"')->where('status', 'Completa')->orderBy('reservation','DESC')->count();
        return view('dashboard.index', [
            'engagements'=>$engagements,
            'totalComplete'=>$engagementsComplete
        ]);
    }
}
