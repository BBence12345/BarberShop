<?php

namespace App\Http\Controllers;

use App\Models\Barber;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class BarberController extends Controller
{
    public function index(Request $request) {
        $barbers = Barber::all();
        return response()->json($barbers, 200, [], JSON_UNESCAPED_UNICODE);
    }
    
    public function store(Request $request) {
        try {
            $request->validate([
                "barber_name" => "required|string|max:255"
            ], [
                "string" => "A(z) :attribute mezőnek szövegesnek kell lennie!",
                "max" => "A(z) :attribute mező maximum :max karakter hosszú lehet!",
                "required" => "A(z) :attribute mező kötelező!"
            ], [
                "barber_name" => "fodrász név"
            ]);
        } catch (ValidationException $ex) {
            return response()->json(["success" => false, "message" => $ex->getMessage()], 400, [], JSON_UNESCAPED_UNICODE);
        }
        
        Barber::create($request->all());
        return response()->json(["success" => true, "message" => "Sikeres létrehozás!"], 200, [], JSON_UNESCAPED_UNICODE);
    }
    
    public function destroy(Request $request) {
        $barber = Barber::find($request->id);
        if ($barber == null) {
            return response()->json(["success" => false, "message" => "Nem található!"], 404, [], JSON_UNESCAPED_UNICODE);
        }
        $barber->delete();
        return response()->json(["success" => true, "message" => "Sikeres törlés!"], 200, [], JSON_UNESCAPED_UNICODE);
    }
}
