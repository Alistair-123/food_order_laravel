<?php

namespace App\Http\Controllers;

use App\Models\FoodItem;

class FoodController extends Controller
{
    public function index()
    {
        $foodItems = FoodItem::all();
        return view('home', compact('foodItems'));
    }
}
