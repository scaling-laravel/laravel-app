<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function pageviews()
    {
        return $this->hasMany(Pageview::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
