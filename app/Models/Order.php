<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function orderForm()
    {
        return $this->hasMany(OrderForm::class);
    }

    public function services()
    {
        return $this->belongsTo(Service::class);
    }

    public function usersOrder()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function delivary()
    {
        return $this->belongsTo(User::class, 'send_to');
    }
    public function conversation()
    {
        return $this->hasOne(Conversation::class, 'order_id');
    }
}
