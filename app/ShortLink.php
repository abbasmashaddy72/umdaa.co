<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ShortLink extends Model
{  
    /**  
     * It is used to display the mass assignable attributes.  
     *  
     * It is used to show @var array  
     */  
    protected $fillable = [  
        'code', 'link', 'expires_at'
    ];  

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'expires_at',
    ];

    public function couldExpire(): bool
    {
        return $this->expires_at !== null;
    }

    /**
     * Return whether an url has expired.
     *
     * @return bool
     */
    public function hasExpired(): bool
    {
        if (! $this->couldExpire()) {
            return false;
        }

        $expiresAt = new Carbon($this->expires_at);

        return ! $expiresAt->isFuture();
    }
}  
