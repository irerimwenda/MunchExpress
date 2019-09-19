<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function saveMenuItem(Request $request)
    {
        $postData = $this->validate($request, [
            'restoraunt_id' => 'required|numeric',
            'price' => 'required|numeric',
            'item' => 'required',
            'description' => 'required|min:3',
            'category' => ['required', new RestoCategoryValidate(request('restoraunt_id'))],
        ]);

        $category = Category::where('restoraunt_id', $postData['restoraunt_id'])->where('name', $postData['category'])->first();

        $menu = Menu::create([
            'restaraunt_id' => $postData['restaraunt_id'],
            'category_id' => $category->id,
            'name' => $postData['item'],
            'description' => $postData['description'],
            'price' => $postData['price'],
        ]);

        return response()->json($menu, 201);
    }
}
