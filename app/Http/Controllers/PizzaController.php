<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredient;
use App\Models\Pizza;

class PizzaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pizzas = Pizza::with('ingredients')->get();

        return view('pizza.index')->with('pizzas', $pizzas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ingredients = Ingredient::orderBy('price')
            ->get();

        return view('pizza.create')->with('ingredients', $ingredients);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sum = 0;
        $ingredients = [];
        $arr = $request->selectedIngredients;

        foreach ($arr as $k => $v) {
            $sum += $v['price'];
        }
        foreach ($arr as $k => $v) {
            $ingredients[] = $v['id'];
        }

        $final_price = $sum + ($sum / 2);

        $pizza = Pizza::create([
            'name' => request()->name,
            'price' => $final_price
        ]);
        
        $pizza->ingredients()->attach($ingredients);

        return redirect()->route('pizza.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Lazy Eager Loading
        $pizza = Pizza::find($id);
        $pizza->load(['ingredients' => function ($query) {
            $query->orderBy('name', 'asc');
        }]);

        $ingredients = Ingredient::orderBy('price')->get();

        return view('pizza.edit', [
            'pizza' => $pizza,
            'ingredients' => $ingredients,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // request data
        $selected = $request->selectedIngredients;
        $name = $request->name;

        // current pizza's ingredients price without added 50%
        $newPrice = 0;
        $passed_id = [];
        $verifiable_id = [];
        $selected_ingredients_id = [];
        $pizza = Pizza::find($id);
        $existing = $pizza->ingredients;

        
        foreach ($selected as $k => $v) {
            $selected_ingredients_id[] = $v['id'];
        }
        foreach ($existing as $k => $v) {
            $verifiable_id[] = $v['id'];
        }
        if(count($verifiable_id) != 0){
            $passed_id = array_intersect($verifiable_id, $selected_ingredients_id);
        }

        // if user doesn't add already existing species
        if(count($passed_id) == 0){
            // summing existing ingredients prices 
            foreach ($existing as $k => $v) {
                $newPrice += $v['price'];
            }
            // summing old ingredients prices with new ones
            foreach ($selected as $k => $v) {
                $newPrice += $v['price'];
            }
            // final price with added 50% of ingredients' price
            $newPrice = $newPrice + ($newPrice / 2);

            $pizza->name = request()->name;
            $pizza->price = $newPrice;
            $pizza->save();

            $pizza->ingredients()->attach($selected_ingredients_id);
            return 'ingredients added';
        } else{
            return 'ingredients already exists';
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id - pizza id
     * @param  int  $request - ingredient id needed to delete
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $newPrice = 0;
        $deletedIngredientId = request()->id;
        $pizza = Pizza::find($id);

        $pizza->ingredients()->detach($deletedIngredientId);

        $existing = $pizza->ingredients;

        // after detaching ingredient recalculate price
        foreach ($existing as $k => $v) {
            $newPrice += $v['price'];
        }
        $newPrice = $newPrice + ($newPrice / 2);

        $pizza->price = $newPrice;
        $pizza->save();

        return $newPrice;
    }
}
