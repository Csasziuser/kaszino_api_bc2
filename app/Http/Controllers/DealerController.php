<?php

namespace App\Http\Controllers;

use App\Models\Dealer;
use Exception;
use Illuminate\Http\Request;
use Throwable;

class DealerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dealers = Dealer::with("table")->get();
        return response()->json($dealers, 200, options:JSON_UNESCAPED_UNICODE);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'gender' => 'required|in:ferfi,no',
            'online' => 'required|boolean',
            'table_id' => 'required|exists:tables,id'
        ],[
            'required' => 'A :attribute mezo kitoltese kötelező',
            'string' => 'A :attribute stringnek kell lennie',
            'in' => 'A :attribute mezőnek férfinek vagy nőnek kell lennie',
            'boolean' => 'A :attribute mezőnek booleannek kell lennie',
            'exists' => 'A :attribute mezőnek léteznie kell'
        ],[
            'name' => 'név',
            'gender' => 'nem',
            "online" => "onlájn",
            'table_id' => 'tábla Id'
        ]);

        try {
            Dealer::create([
                'name' => $request->name,
                'gender' => $request->gender,
                'online' => $request->online,
                'table_id' => $request->table_id
            ]);
    
            return response()->json(['uzenet' => 'Sikeresen rögzítve.'], 201, options:JSON_UNESCAPED_UNICODE);
        } catch (Throwable $ex) {
            return response()->json(['uzenet' => 'Meghiúsult az adat létrehozása.'], 500, options:JSON_UNESCAPED_UNICODE);
        }
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
        $dealer = Dealer::find($id);

        if (!$dealer) {
            return response()->json(["uzenet" => "Nincs dealer ezzel az id-val"], 404, options:JSON_UNESCAPED_UNICODE);
        }

        $request->validate([
            'online' => 'sometimes|required|boolean',
            'table_id' => 'sometimes|required|exists:tables,id'
        ],[
            'required' => 'A :attribute mezo kitoltese kötelező',
            'boolean' => 'A :attribute mezőnek booleannek kell lennie',
            'exists' => 'A :attribute mezőnek léteznie kell'
        ],[
            "table_id" => "tábla Id",
            "online" => "onlájn"
        ]);
        
        if($request->has("online"))
        {
            $dealer->online = $request->online;
        };
        if($request->has("table_id"))
        {
            $dealer->table_id = $request->table_id;
        };

        $dealer->save();

        return response()->json(["uzenet" => "A módosítás sikeres"], 200, options:JSON_UNESCAPED_UNICODE);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
