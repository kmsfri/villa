<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteComment extends Model
{
    protected $table = 'website_comments';
    protected $primaryKey = 'id';

    public function WritenBy()
    {
        return $this->belongsTo('App\Models\RenterUser');
    }
}
