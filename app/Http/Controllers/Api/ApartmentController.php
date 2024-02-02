<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function index(Request $request)
    {
        // $results = Apartment::with('services')->limit(20);
        $results = Apartment::all();

        return response()->json([
            'results' =>$results,
            'success' => true
        ]);
    }
}
