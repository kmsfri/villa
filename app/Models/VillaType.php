<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VillaType extends Model
{
    protected $table = 'villa_type';
    protected $primaryKey = 'id';

    public function Villa()
    {
        return $this->hasMany('App\Models\Villa');
    }
}
