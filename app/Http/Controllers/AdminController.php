<?php

namespace App\Http\Controllers;

use App\Models\Cart; // Ensure this model exists and is correct
use App\Models\FoodItem;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $foodItems = FoodItem::paginate(10);
        return view('admin.foods', compact('foodItems'));
    }

    public function addFood(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255', // Optional: max character limit
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Ensure to specify allowed image formats
        ]);

        // Additional validation for word count
        if (str_word_count($request->description) > 20) {
            return back()->withErrors(['description' => 'The description may not exceed 20 words.']);
        }

        $imagePath = $request->file('image')->store('images', 'public');

        FoodItem::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Food item added successfully!');
    }

    public function deleteFood($id)
    {
        $foodItem = FoodItem::find($id);

        if ($foodItem) {
            // Delete related cart items first
            Cart::where('food_item_id', $id)->delete();

            // Now delete the food item
            if (Storage::exists('public/' . $foodItem->image)) {
                Storage::delete('public/' . $foodItem->image);
            }

            $foodItem->delete();

            return redirect()->back()->with('success', 'Food item deleted!');
        }

        return redirect()->back()->with('error', 'Food item not found!');
    }

    public function viewPurchases()
    {
        $purchases = Purchase::all();
        return view('admin.purchases', compact('purchases'));
    }

    public function update(Request $request, $id)
    {
        // Validate the input
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255', // Optional: max character limit
            'price' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Ensure to specify allowed image formats
        ]);

        // Additional validation for word count
        if (str_word_count($request->description) > 20) {
            return back()->withErrors(['description' => 'The description may not exceed 20 words.']);
        }

        // Update the food item
        $foodItem = FoodItem::findOrFail($id);
        $foodItem->update($request->all());

        return redirect()->route('admin.food.index')->with('success', 'Food item updated successfully!');
    }

    public function editFood($id)
{
    $foodItem = FoodItem::findOrFail($id);
    return view('admin.edit-food', compact('foodItem'));
}

public function updateFood(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'price' => 'required|numeric',
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Optional: Update image if new one is uploaded
    ]);

    $foodItem = FoodItem::findOrFail($id);

    // Update image if a new one is uploaded
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images', 'public');
        $foodItem->image = $imagePath;
    }

    $foodItem->update([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
    ]);

    return redirect()->route('admin.index')->with('success', 'Food item updated successfully!');
}

}
