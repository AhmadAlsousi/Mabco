<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $fillable = ['user_id','expire_at'];
    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}
public function cartitems()
{

    return $this->hasMany(CartItem::class);
}
}
