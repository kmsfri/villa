<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class AdminUser extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table='admin_users';

    protected $fillable = [
        'user_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function Routes()
    {
        return $this->belongsToMany('App\Models\AdminRoutes','admin_route_admin_user','admin_user_id','admin_route_id');
    }

    public function CheckRouteID($route_id)
    {
        return $this->belongsToMany('App\Models\AdminRoutes','admin_route_admin_user','admin_user_id','admin_route_id')
            ->where('admin_routes.id','=',$route_id)
            ->count();
    }

    public function Tickets()
    {
        return $this->hasMany('App\Models\Ticket');
    }

    public function Contents()
    {
        return $this->hasMany('App\Models\Content');
    }

    public function ConfigurationUpdates()
    {
        return $this->hasMany('App\Models\Configuration','updated_by');
    }

}
