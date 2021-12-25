<?php

namespace App\Models;

use App\Models\Hr\HrDepartment;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'subject', 'status' , 'priority','start_at','description','department_id ','move_date',
        'customer_id','is_moved','move_type','move_description','closed_by','closed_at',
    ];

  //  protected $hidden = ['pivot'];
    public function users(){
        return $this->belongsToMany(User::class , 'tickets_users');

    }//end of users relation

    public function relocators(){
        return $this->belongsToMany(User::class , 'moved_tickets');

    }//end of users relation

    public function ticketAttachments(){
        return $this->hasMany(TicketAttachment::class, 'ticket_id', 'id');
    }

    public function ticketReplies(){
        return $this->hasMany(TicketReply::class, 'ticket_id', 'id');
    }

    public function department()
    {
        return $this->belongsTo(HrDepartment::class, 'department_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function moved(){
        return $this->belongsToMany(User::class , 'moved_tickets');

    }//end of users relation

}
