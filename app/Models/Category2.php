<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category2 extends Model
{
    protected $table = 'categories2';
    protected $primaryKey = 'id';

    public function Villas()
    {
        return $this->belongsToMany('App\Models\Villa','villa_category2');
    }

    public function SubCategory2()
    {
        return $this->hasMany('App\Models\Category2','parent_id');
    }

    public function SubCategory2EnabledOrdered()
    {
        return $this->hasMany('App\Models\Category2','parent_id')
            ->where('category_status','=',1)
            ->orderBy('category_order','ASC');
    }

    public function ParentCategory2()
    {
        return $this->belongsTo('App\Models\Category2','parent_id');
    }

}
