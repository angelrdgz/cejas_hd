<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Engagement;

use Auth;

class DashboardController extends Controller
{
    public function index()
    {
        switch (Auth::user()->role_id) {
            case 1:
                $engagements = Engagement::whereRaw('DATE(reservation) = "'.date('Y-m-d').'"')->orderBy('reservation','DESC')->get();
                $next = Engagement::whereRaw('DATE(reservation) = "'.date('Y-m-d').'"')->orderBy('reservation','DESC')->where('status', 'Confirmada')->limit(1)->first();
                $money = Engagement::join('services','services.id', 'engagements.service_id')->whereRaw('DATE(engagements.reservation) = "'.date('Y-m-d').'"')->where('engagements.status', 'Completa')->sum('services.price');
        $engagementsComplete = Engagement::whereRaw('DATE(reservation) = "'.date('Y-m-d').'"')->where('status', 'Completa')->count();
        return view('dashboard.index', [
            'engagements'=>$engagements,
            'totalComplete'=>$engagementsComplete,
            'money'=>$money,
            'next'=>$next
        ]);
                break;
            default:
            $engagements = Engagement::where('branch_id', Auth::user()->branch_id)->whereRaw('DATE(reservation) = "'.date('Y-m-d').'"')->orderBy('reservation','DESC')->get();
            $engagementsComplete = Engagement::where('branch_id', Auth::user()->branch_id)->whereRaw('DATE(reservation) = "'.date('Y-m-d').'"')->where('status', 'Completa')->orderBy('reservation','DESC')->count();
            return view('dashboard.index', [
                'engagements'=>$engagements,
                'totalComplete'=>$engagementsComplete
            ]);
        }
    }
}
