<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Restaurant;

class Order extends Model
{
    protected $guarded = [];

    protected $table = 'orders';

    protected $casts = [
        'order_details' => 'array'
    ];

    public function restaurant() {
        return $this->belongsTo(Restaurant::class, 'restaurant_id');
    }
}
