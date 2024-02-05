<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $current_user = Auth::id();
        $orders = [];
        
        if ($current_user == '1') {
            $apartments = Apartment::all();
            $orders = Order::all();
        } else {
            $apartments = Apartment::where('user_id', $current_user)->get();

            foreach($apartments as $apartment) {
                $current_apartment_id = $apartment['id'];
                $current_orders = Order::where('apartment_id', $current_apartment_id)->get();
                if($current_orders) {
                    array_push($orders, $current_orders);
                }
            }
            //  dd($orders);
        }

        return view('admin.dashboard', compact('apartments', 'orders'));
    }
}
