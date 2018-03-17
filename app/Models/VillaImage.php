<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VillaImage extends Model
{
    protected $table = 'villa_images';
    protected $primaryKey = 'id';

    public function Villa()
    {
        return $this->belongsTo('App\Models\Villa');
    }
}
