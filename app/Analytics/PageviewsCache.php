<?php

namespace App\Analytics;

use Cache;

class PageviewsCache implements Views
{
    /**
     * @var Views
     */
    private $next;

    /**
     * PageviewsCache constructor.
     * @param Views $next
     */
    public function __construct(Views $next)
    {
        $this->next = $next;
    }

    /**
     * @param $days
     * @param null $domain
     * @param null $customer
     * @return mixed
     */
    public function daysBack($days, $domain = null, $customer = null)
    {
        $cacheKey = md5(vsprintf('%s.%s.%s.%s', [
            auth()->user()->id,
            $days,
            $domain,
            $customer,
        ]));

        return Cache::remember($cacheKey, 60, function () use($days, $domain, $customer) {
            return $this->next->daysBack($days, $domain, $customer);
        });
    }

    /**
     * @return mixed
     */
    public function domains()
    {
        $cacheKey = md5(vsprintf('%s.%s', [
            auth()->user()->id,
            'domains',
        ]));

        return Cache::remember($cacheKey, 60, function() {
            return $this->next->domains();
        });
    }
}