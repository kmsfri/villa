<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserVillaReports extends Model
{
    protected $table = 'user_villa_reports';
    protected $primaryKey = 'id';

    public function Villa()
    {
        return $this->belongsTo('App\Models\Villa');
    }

    public function RenterUser()
    {
        return $this->belongsTo('App\Models\RenterUSer');
    }
}
