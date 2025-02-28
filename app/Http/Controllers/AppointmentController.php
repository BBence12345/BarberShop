<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AppointmentController extends Controller
{
    public function index(Request $request) {
        $appointments = Appointment::all();
        return response()->json($appointments, 200, [], JSON_UNESCAPED_UNICODE);
    }
    
    public function store(Request $request) {
        try {
            $request->validate([
                "name" => "required|string|max:255",
                "barber_id" => "required|integer",
                "appointment" => "required|date"
            ], [
                "string" => "A(z) :attribute mezőnek szövegesnek kell lennie!",
                "integer" => "A(z) :attribute mezőnek egész számnak kell lennie!",
                "max" => "A(z) :attribute mező maximum :max karakter hosszú lehet!",
                "date" => "A(z) :attribute mezőnek dátumnak kell lennie!",
                "required" => "A(z) :attribute mező kötelező!"
            ], [
                "name" => "név",
                "barber_id" => "fodrász id",
                "appointment" => "időpont"
            ]);
        } catch (ValidationException $ex) {
            return response()->json(["success" => false, "message"=> $ex->getMessage()], 400, [], JSON_UNESCAPED_UNICODE);
        }
        
        Appointment::create($request->all());
        return response()->json(["success" => true, "message"=> "Sikeres létrehozás!"], 200, [], JSON_UNESCAPED_UNICODE);
    }
    
    public function destroy(Request $request) {
        $appointment = Appointment::find($request->id);
        if ($appointment == null) {
            return response()->json(["success" => false, "message"=> "Nem található!"], 404, [], JSON_UNESCAPED_UNICODE);
        }
        $appointment->delete();
        return response()->json(["success" => true, "message"=> "Sikeres törlés!"], 200, [], JSON_UNESCAPED_UNICODE);
    }
}
