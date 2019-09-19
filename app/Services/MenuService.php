<?php

namespace App\Services;
use App\Models\Menu;

class MenuService

{
    public function getMenuWithCategory(array $restoraountIds) {
        
        $categories = Menu::whereIn('restoraunt_id', $restoraountIds)
        ->get()
        ->groupBy('category.name');

        return $categories;
    }
}