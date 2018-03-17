<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RenterUserLink extends Model
{
    protected $table = 'renter_user_links';
    protected $primaryKey = 'id';

    public function RenterUser()
    {
        return $this->belongsTo('App\Models\RenterUser');
    }
}
