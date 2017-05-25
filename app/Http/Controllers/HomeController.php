<?php

namespace App\Http\Controllers;

use App\Pageviews;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        switch(request()->get('timeline', 'week'))
        {
            case 'month':
                $fn = 'lastMonth';
                $param = null;
                break;
            case 'quarter':
                $fn = 'lastDays';
                $param = 90;
                break;
            case 'week':
            default:
                $fn = 'lastWeek';
                $param = null;
                break;
        }



        $pageViews = ( new PageViews(auth()->user()) )
            ->$fn($param); //lastWeek() lastMonth(), lastDays(int $days)

        return view('home', [
            'pageviews' => $pageViews,
        ]);
    }
}
