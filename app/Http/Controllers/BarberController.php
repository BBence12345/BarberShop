<?php

namespace App\Http\Controllers;

use App\Models\Barber;
use Illuminate\Http\Request;

class BarberController extends Controller
{
    public function index(Request $request) {
        $barbers = Barber::all();
        return response()->json($barbers, 200, [], JSON_UNESCAPED_UNICODE);
    }
    
    public function store(Request $request) {

    }
    
    public function destroy(Request $request) {
        $barber = Barber::find($request->id);
        if ($barber == null) {
            return response()->json(["success" => false, "message"=> "Nem található!"], 404, [], JSON_UNESCAPED_UNICODE);
        }
        $barber->delete();
        return response()->json(["success" => true, "message"=> "Sikeres törlés!"], 200, [], JSON_UNESCAPED_UNICODE);
    }
}
