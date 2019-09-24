<?php

namespace App\Http\Controllers;

use App\Services\MenuService;
use App\Services\RestaurantService;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(MenuService $service, RestaurantService $restaurantService)
    {
        //$restoraunt_ids = [1];
        $restoraunt_id = 1;

        //$menus = $service->getMenuWithCategory($restoraunt_ids);
        $menus = $service->getMenuWithCategory($restoraunt_id);
        $restaurants = $restaurantService->userRestaurantAndTables();

        return view('home', compact('menus', 'restoraunt_id', 'restaurants'));
    }
}
