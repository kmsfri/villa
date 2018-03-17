<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminRoutesUri extends Model
{
    protected $table = 'admin_route_uri';
    protected $primaryKey = 'id';

    public function AdminRoute()
    {
        return $this->belongsTo('App\Models\AdminRoutes');
    }

    public function getParent()
    {
        return $this->belongsTo('App\Models\AdminRoutes','admin_route_id');
    }
}
