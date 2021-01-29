<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ingredient;

class Pizza extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price'
    ];

    public function ingredients(){
    	 return $this->belongsToMany(Ingredient::class, 'ingredients_pizzas');
    }
}
