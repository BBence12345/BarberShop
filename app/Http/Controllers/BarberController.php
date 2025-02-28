<?php

namespace App\Http\Controllers;

use App\Models\Barber;
use Illuminate\Http\Request;

class BarberController extends Controller
{
    public function index(Request $request) {
        $barbers = Barber::all();
        return response()->json($barbers, 200);
    }
    
    public function store(Request $request) {

    }
    
    public function destroy(Request $request) {

    }
}
