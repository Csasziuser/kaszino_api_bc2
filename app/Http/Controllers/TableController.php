<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;
class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tables = Table::all();
        return response()->json($tables, 200, options:JSON_UNESCAPED_UNICODE);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "game" => "required|string",
            "min_bet" => "required|integer|min:1|lt:max_bet",
            "max_bet" => "required|integer|gt:min_bet",
        ],[
            "game.string" => "A játék neve szöveges legyen",
            "min" =>":attribute legalább 1-nek kell lennie",
            "lt" =>":attribute mezőnek kisebbnek kell lennie mint a :value",
            "gt" =>":attribute mezőnek nagyobbnak kell lennie mint a :value",
            "integer" => "A :attribute egész szám legyen",
            "required"=>":attribute mező kitöltése kötelező",
        ],[
            "game"=>"Játék",
            "min_bet"=>"Minimum tét",
            "max_bet"=>"Maximum tét"
        ]); 
        Table::create($request->all());
        return response()->json(['message'=>'sikeres rögzítés'],201,options:JSON_UNESCAPED_UNICODE);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $table = Table::find($id);
        if(!$table){
            return response()->json(["message" => "Nincs ilyen id-val rendelkező asztal a rendszerben"], 404, options:JSON_UNESCAPED_UNICODE);
        }
        $request -> validate([
            "min_bet" => "required|integer|min:1|lt:max_bet",
            "max_bet" => "required|integer|gt:min_bet",
        ],[
            "min" =>":attribute legalább 1-nek kell lennie",
            "lt" =>":attribute mezőnek kisebbnek kell lennie mint a :value",
            "gt" =>":attribute mezőnek nagyobbnak kell lennie mint a :value",
            "integer" => "A :attribute egész szám legyen",
            "required"=>":attribute mező kitöltése kötelező",
        ],[
            "min_bet"=>"Minimum tét",
            "max_bet"=>"Maximum tét"
        ]);
        $table -> update($request->all());
        return response()->json(["message" => "Sikeresen frissült az asztal"], 201, options:JSON_UNESCAPED_UNICODE);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
