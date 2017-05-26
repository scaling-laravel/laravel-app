<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Analytics\Pageview;
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
     * @param Pageview $pageViews
     * @return \Illuminate\Http\Response
     */
    public function index(Pageview $pageViews)
    {
        // Filters
        $daysBack = (int)request()->get('timeline', 7);
        $domain = request()->get('domain', null);
        $customer = request()->get('customer', null);

        return view('home', [
            'pageviews' => $pageViews->daysBack($daysBack, $domain, $customer),
            'domains' => $pageViews->domains(),
            'customers' => Customer::select('id')->where('user_id', auth()->user()->id)->get(),
        ]);
    }
}
