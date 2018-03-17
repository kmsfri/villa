<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category3 extends Model
{
    protected $table = 'categories3';
    protected $primaryKey = 'id';

    public function Contents()
    {
        return $this->belongsToMany('App\Models\Content','content_category3');
    }

    public function SubCategory3()
    {
        return $this->hasMany('App\Models\Category3','parent_id');
    }

    public function SubCategory3EnabledOrdered()
    {
        return $this->hasMany('App\Models\Category3','parent_id')
            ->where('category_status','=',1)
            ->orderBy('category_order','ASC');
    }

    public function ParentCategory3()
    {
        return $this->belongsTo('App\Models\Category3','parent_id');
    }

}
