<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['buyer_id', 'total_price'];

    // Add this relationship
    public function user()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    // You probably also want this
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}