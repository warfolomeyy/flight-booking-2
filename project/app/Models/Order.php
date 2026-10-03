<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'products',
        'order_price',
    ];

    protected $casts = [
        'products' => 'array', // превращает JSON из базы в удобный PHP-массив
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
