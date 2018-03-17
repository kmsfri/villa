<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketMessage extends Model
{
    protected $table = 'ticket_messages';
    protected $primaryKey = 'id';

    public function Ticket()
    {
        return $this->belongsTo('App\Models\Ticket');
    }

}
