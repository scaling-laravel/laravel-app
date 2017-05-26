<?php

namespace App\Analytics;

use DB;
use DateTime;
use App\User;
use App\Pageview as Views;

class Pageviews implements Pageview
{

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function daysBack($days, $domain=null, $customer=null)
    {
        // Get very beginning of the day, $date days ago
        $date = new DateTime(date('Y-m-d', strtotime('-'.$days.' days')));

        $query = Views::select(DB::raw('COUNT(id) as daily_total, DATE(created_at) as date'))
            ->where('user_id', $this->user->id)
            ->where('created_at', '>=', $date)
            ->groupBy('date')
            ->orderBy('date', 'asc');

        if( $domain ) $query->where('domain', $domain);
        if( $customer ) $query->where('customer_id', $customer);

        return $query->get();
    }

    public function domains()
    {
        return Views::select(DB::raw('DISTINCT domain'))
            ->where('user_id', $this->user->id)
            ->get();
    }

}