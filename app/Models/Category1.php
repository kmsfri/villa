<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category1 extends Model
{
    protected $table = 'categories1';
    protected $primaryKey = 'id';

    public function Villas()
    {
        return $this->belongsToMany('App\Models\Villa','villa_category1','category_id','villa_id');
    }

    public function SubCategory1()
    {
        return $this->hasMany('App\Models\Category1','parent_id');
    }

    public function SubCategory1EnabledOrdered()
    {
        return $this->hasMany('App\Models\Category1','parent_id')
            ->where('category_status','=',1)
            ->orderBy('category_order','ASC');
    }

    public function ParentCategory1()
    {
        return $this->belongsTo('App\Models\Category1','parent_id');
    }

}
