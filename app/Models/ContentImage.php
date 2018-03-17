<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentImage extends Model
{
    protected $table = 'content_images';
    protected $primaryKey = 'id';

    public function Content()
    {
        return $this->belongsTo('App\Models\Content');
    }
}
