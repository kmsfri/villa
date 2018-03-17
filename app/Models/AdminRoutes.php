<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminRoutes extends Model
{
    protected $table = 'admin_routes';
    protected $primaryKey = 'id';

    public function AdminRouteUri()
    {
        return $this->hasMany('App\Models\AdminRouteUri');
    }

    public function AdminUser()
    {
        return $this->belongsToMany('App\Models\AdminUser');
    }
}
