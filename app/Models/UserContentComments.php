<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserContentComments extends Model
{
    protected $table = 'user_content_comments';
    protected $primaryKey = 'id';

    public function Content()
    {
        return $this->belongsTo('App\Models\Content');
    }

    public function RenterUser()
    {
        return $this->belongsTo('App\Models\RenterUSer');
    }
}
