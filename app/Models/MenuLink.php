<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuLink extends Model
{
    protected $table = 'menu_links';
    protected $primaryKey = 'id';


    public function SubLinks()
    {
        return $this->hasMany('App\Models\MenuLink','parent_id');
    }

    public function SubLinkEnabledOrdered()
    {
        return $this->hasMany('App\Models\MenuLink','parent_id')
            ->where('link_status','=',1)
            ->orderBy('link_order','ASC');
    }

    public function ParentLink()
    {
        return $this->belongsTo('App\Models\MenuLink','parent_id');
    }
}
