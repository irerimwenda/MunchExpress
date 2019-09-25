<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $guarded = [];

    protected $appends = ['slug', 'ordersSlug'];

    public function owner() {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function orders() {
        return $this->hasMany(Order::class, 'restaurant_id');
    }

    public function getSlugAttribute() {
        return route('restaurants.menu', $this->id);
    }

    public function getOrdersSlugAttribute() {
        return route('restaurants.orders', $this->id);
    }
}
