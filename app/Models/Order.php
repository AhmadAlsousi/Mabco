<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $fillable = ['user_id', 'college_cost', 'status'];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function orderitems()
    {

        return $this->hasMany(OrderItems::class);
    }
}
