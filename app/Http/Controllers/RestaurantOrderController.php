<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Restaurant;
use App\Order;
use App\Models\Menu;

use DB;
use Auth;

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
        ->orderByDesc('created_at')
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
        //logger($request->all());

        $postData = $this->validate($request, [
            //'restaurant_id' => 'required|exists:restaurants, id'
            'restaurant_id' => 'required',
            'order_data' => 'required|array'
        ]);

        $itemIds = $postData['order_data']['orderDetails'];

        try {
            DB::beginTransaction();

            $orderTotal = 0;

            foreach($itemIds as $id) {
                $menu = Menu::query()
                ->where('restoraunt_id', $postData['restaurant_id'])
                ->where('id', $id)
                ->first();

                if($menu)  {
                    $orderTotal += $menu->price;
                }
            }

            $order = Order::create([
                'restaurant_id' => $postData['restaurant_id'],
                'user_id' => Auth::user()->id,
                'amount' => $orderTotal,
                'isComplete' => 0,
                'order_details' => [
                    'items' => $postData['order_data']['orderDetails'],
                    'customer_name' => $postData['order_data']['customerDetails']['name'],
                    'customer_phone' => $postData['order_data']['customerDetails']['phone'],
                    'customer_address' => $postData['order_data']['customerDetails']['address'],
                ]
            ]);

        //logger($orderTotal);

        DB::commit();

        } catch (\Exception $e) {
            logger($e->getMessage());
            DB::rollback();
            return response()->json(['message' => $e->getMessage()], 500);
        }

        //return $request->all();
        return response()->json($order, 201);
    }
}
