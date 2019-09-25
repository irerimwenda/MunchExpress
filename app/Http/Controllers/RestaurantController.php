<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Services\RestaurantService;

class RestaurantController extends Controller
{

    //Index
    public function index(RestaurantService $restaurantService) 
    {
        $restaurants = $restaurantService->userRestaurantAndTables();
        return view('restaurant.restaurant-index', compact('restaurants'));
    }

    //Store Restaurant
    public function store(Request $request) 
    {
        $postData = $this->validate($request, array(
            'name' => 'required|min:3',
            'location' => 'required|min:3',
            'tables' => 'required|integer',
        ));

        $restaurant = Auth::user()->restaurants()->create($postData);

        return response()->json($restaurant, 201);
        //return $request->all();
    }
}
 