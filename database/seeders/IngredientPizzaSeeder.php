<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\IngredientPizza;

class IngredientPizzaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
    		['pizza_id' => 1, 'ingredient_id' => 1],
    		['pizza_id' => 1, 'ingredient_id' => 2],
    		['pizza_id' => 2, 'ingredient_id' => 1],
    		['pizza_id' => 2, 'ingredient_id' => 2],
    		['pizza_id' => 2, 'ingredient_id' => 3],
    		['pizza_id' => 2, 'ingredient_id' => 4],
    		['pizza_id' => 2, 'ingredient_id' => 5],
    		['pizza_id' => 3, 'ingredient_id' => 2],
    		['pizza_id' => 3, 'ingredient_id' => 6],
    		['pizza_id' => 3, 'ingredient_id' => 7],
    		['pizza_id' => 4, 'ingredient_id' => 1],
    		['pizza_id' => 4, 'ingredient_id' => 2],
    		['pizza_id' => 4, 'ingredient_id' => 3],
    		['pizza_id' => 4, 'ingredient_id' => 6],
    		['pizza_id' => 5, 'ingredient_id' => 2],
    		['pizza_id' => 5, 'ingredient_id' => 9],
    		['pizza_id' => 5, 'ingredient_id' => 10]
    	];
        
        IngredientPizza::insert($data);
    }
}
