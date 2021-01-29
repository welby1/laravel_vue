<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pizza;
use Carbon\Carbon;

class PizzaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
    		[
    			'name' => 'Pepperoni',
    			'price' => 5.25,
    			'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    			'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
    		],
    		[
    			'name' => 'Supreme',
    			'price' => 13.2,
    			'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    			'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
    		],
    		[
    			'name' => 'Hawaiian',
    			'price' => 5.85,
    			'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    			'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
    		],
    		[
    			'name' => 'BBQ Meatlovers',
    			'price' => 10.2,
    			'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    			'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
    		],
    		[
    			'name' => 'Sausage & Kale',
    			'price' => 5.7,
    			'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    			'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
    		],
    	];
        
        Pizza::insert($data);
    }
}
