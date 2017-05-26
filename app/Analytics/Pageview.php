<?php

namespace App\Analytics;


interface Pageview
{
    /**
     * @param $days
     * @param null $domain
     * @param null $customer
     * @return mixed
     */
    public function daysBack($days, $domain=null, $customer=null);

    /**
     * @return mixed
     */
    public function domains();
}