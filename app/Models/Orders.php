<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_date',
        'total_amount',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class, 'order_id', 'id');
    }

    public function items()
    {
        return $this->hasMany(OrderDetails::class, 'order_id', 'id');
    }
}
