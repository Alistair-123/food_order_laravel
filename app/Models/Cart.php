<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['food_item_id', 'quantity'];

    public function foodItem()
    {
        return $this->belongsTo(FoodItem::class);
    }
}
