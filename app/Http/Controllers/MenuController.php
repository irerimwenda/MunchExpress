<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\RestorauntCategoryValidate;

use App\Models\Menu;
use App\Models\Category;
use App\Services\MenuService;

class MenuController extends Controller
{

    //Index
    public function index($id)
    {
        $restoraunt_id = $id;
        $service = new MenuService;
        $menus = $service->getMenuWithCategory($restoraunt_id);

        return view('menu.menu-index', compact('menus', 'restoraunt_id'));
    }


    public function saveMenuItem(Request $request)
    {
        $postData = $this->validate($request, [
            'restoraunt_id' => 'required|numeric',
            'price' => 'required|numeric',
            'item' => 'required',
            'description' => 'required|min:3',
            //'category' => ['required', new RestorauntCategoryValidate(request('restoraunt_id'))],
            'category' => 'required',
        ]);

        $conditions = [
            'restoraunt_id' => $postData['restoraunt_id'],
            'name' => $postData['category'],
        ];

        $category = Category::where($conditions)->first();
        //$category = Category::where('restoraunt_id', $postData['restoraunt_id'])->where('name', $postData['category'])->first();

        $menu = $category->menus()->create([
        //$menu = Menu::create([
            'restoraunt_id' => $postData['restoraunt_id'],
            //'category_id' => $category->id,
            'name' => $postData['item'],
            'description' => $postData['description'],
            'price' => $postData['price'],
        ]);

        return response()->json($menu, 201);
    }

    /* public function saveMenuItem(Request $request) 
    {
        //return $request->all();

        $postData = $this->validate($request, [
            'restoraunt_id' => 'required|numeric',
            'price' => 'required|numeric',
            'item' => 'required',
            'category' => ['required', new RestorauntCategoryValidate(request('restoraunt_id'))],
        ]);

        return $postData;
    } */
}
