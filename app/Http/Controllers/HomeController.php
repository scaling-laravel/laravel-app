<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Pageviews;
use Illuminate\Http\Request;

class HomeController extends Controller
{
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
        // Filters
        $daysBack = (int)request()->get('timeline', 7);
        $domain = request()->get('domain', null);
        $customer = request()->get('customer', null);

        // Pageview "Repository"
        $pageViews = new PageViews(auth()->user());

        return view('home', [
            'pageviews' => $pageViews->daysBack($daysBack, $domain, $customer),
            'domains' => $pageViews->domains(),
            'customers' => Customer::select('id')->where('user_id', auth()->user()->id)->get(),
        ]);
    }
}
