<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderDetails;

class Products extends Model
{


 protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
        'image',
    ];
    use HasFactory;
    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
