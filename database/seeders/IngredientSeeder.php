<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ingredient;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$data = [
    		['name' => 'Pepperoni', 'price' => 2],
    		['name' => 'Mozzarella', 'price' => 1.5],
    		['name' => 'Bacon', 'price' => 2.3],
    		['name' => 'Onion', 'price' => 1.3],
    		['name' => 'Mushroom', 'price' => 1.7],
    		['name' => 'Ham', 'price' => 1],
    		['name' => 'Pineapple', 'price' => 1.4],
    		['name' => 'Chilli', 'price' => 2.2],
    		['name' => 'Sausage', 'price' => 1.8],
    		['name' => 'Kale', 'price' => 0.5]
    	];
        
        Ingredient::insert($data);
    }
}
