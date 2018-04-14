<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VillaImage extends Model
{
    protected $table = 'villa_images';
    protected $primaryKey = 'id';

    protected $fillable = [
        'image_dir','image_order',
    ];


    public function Villa()
    {
        return $this->belongsTo('App\Models\Villa');
    }
}
