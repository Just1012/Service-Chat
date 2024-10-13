<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function order(){
        return $this->belongsTo(Order::class,'order_id');
    }
    public function message(){
        return $this->belongsTo(messages::class,'conversation_id');
    }

    
}
