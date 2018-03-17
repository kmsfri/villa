<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VillaReserveRequest extends Model
{
    protected $table = 'villa_reserve_requests';
    protected $primaryKey = 'id';

    public function Villa()
    {
        return $this->belongsTo('App\Models\Villa');
    }
}
