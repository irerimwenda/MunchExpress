<?php

namespace App\Services;
use App\Models\Menu;

class MenuService

{
    //public function getMenuWithCategory(array $restorauntIds) {
    public function getMenuWithCategory($restoraunt_id) {
        
        //$categories = Menu::whereIn('restoraunt_id', $restorauntIds)
        $categories = Menu::where('restoraunt_id', $restoraunt_id)
        ->get()
        ->groupBy('category.name');

        return $categories;
    }
}