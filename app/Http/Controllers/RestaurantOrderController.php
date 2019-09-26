<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Restaurant;
use App\Order;

class RestaurantOrderController extends Controller
{
    public function index($id)
    {
        $restaurant = Restaurant::find($id);

        if(!$restaurant) {
            abort(404, 'The restaurant you are looking for is not present');
        }

        $orders = Order::where('restaurant_id', $id)
        ->orderBy('isComplete')
        ->paginate(20);

        return view('orders.order-index')
        ->with('restaurant', $restaurant)
        ->with('orders', $orders);
    }

    public function add($id) 
    {
        $restaurant = Restaurant::findOrFail($id);

        return view('orders.order-add', compact('restaurant'));
    }

    public function store(Request $request) {
        logger($request->all());
        return $request->all();
    }
}
