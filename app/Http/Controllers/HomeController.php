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
        $pageViews = ( new PageViews(auth()->user()) )
            ->lastWeek(); //lastMonth(), lastDays(int $days)

        return view('home', [
            'pageviews' => $pageViews,
        ]);
    }
}
