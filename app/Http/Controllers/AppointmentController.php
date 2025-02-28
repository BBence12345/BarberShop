<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(Request $request) {
        $appointments = Appointment::all();
        return response()->json($appointments, 200);
    }
    
    public function store(Request $request) {

    }
    
    public function destroy(Request $request) {

    }
}
