<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';
    protected $primaryKey = 'id';

    public function RenterUser()
    {
        return $this->belongsTo('App\Models\RenterUser');
    }

    public function AdminUser()
    {
        return $this->belongsTo('App\Models\AdminUser');
    }

    public function TicketMessages()
    {
        return $this->hasMany('App\Models\TicketMessage');
    }
}
