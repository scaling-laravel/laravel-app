<?php

namespace App;

use DB;

class Pageviews
{

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function lastWeek()
    {
        return $this->lastDays(7);
    }

    public function lastMonth()
    {
        return $this->lastDays(30);
    }

    public function lastDays($days)
    {
        // Get very beginning of the day, $date days ago
        $date = new \DateTime(date('Y-m-d', strtotime('-'.$days.' days')));

        return Pageview::select(DB::raw('COUNT(id) as daily_total, DATE(created_at) as date'))
            ->where('user_id', $this->user->id)
            ->where('created_at', '>=', $date)
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();
    }

}