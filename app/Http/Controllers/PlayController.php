<?php

namespace App\Http\Controllers;

use App\Pageview;
use Illuminate\Http\Request;

class PlayController extends Controller
{
    public function index()
    {
        $pageviews = Pageview::select('domain')
            ->where('domain', 'like', '%.biz')
            ->where('created_at', '>=', new \Datetime('@'.strtotime('-30 days')))
            ->chunk(10000, function($pageviews) {
                // do something with $pageviews
            });

        return 'Memory Usage: '. round(xdebug_peak_memory_usage()/1048576, 2) . 'MB';
    }
}
