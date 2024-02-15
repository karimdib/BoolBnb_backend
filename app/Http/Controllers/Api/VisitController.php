<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVisitRequest;
use App\Models\Visit;

class VisitController extends Controller
{
    public function save() 
    {
         $request = request();

         $new_visit = new Visit();
         $new_visit->ip_address = $request->IPAddress;
         $new_visit->date = $request->date;
         $new_visit->apartment_id = $request->apartmentID;
         $new_visit->save();

        return response()->json([
            'success' => true
        ]);
    }
}
