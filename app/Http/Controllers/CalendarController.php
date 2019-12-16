<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Engagement;
use Auth;

class CalendarController extends Controller
{

    public function index()
    {
        switch (Auth::user()->role_id) {
            case 1:
                $engagements = Engagement::all();
                break;            
            default:
            $engagements = Engagement::where('branch_id', Auth::user()->branch_id)->get();
                break;
        }
        
        return view('calendar.index', ['engagements'=>$engagements]);
    }
}
