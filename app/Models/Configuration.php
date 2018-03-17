<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $table = 'configuration';
    protected $primaryKey = 'id';

    public function AdminUser()
    {
        return $this->belongsTo('App\Models\AdminUser','updated_by');
    }

    public function WebsiteLogo(){
        return $this->where('config_key','=','website_logo');
    }

}
