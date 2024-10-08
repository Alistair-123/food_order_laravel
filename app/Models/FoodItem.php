<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodItem extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'image'];

    // In app/Models/FoodItem.php
public function getLimitedDescriptionAttribute()
{
    // Limit description to 20 words
    return implode(' ', array_slice(explode(' ', $this->description), 0, 20));
}


}

