<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $current_user = Auth::id();
        $user = User::find($current_user);

        $user_apartments = $user->apartments()->with('orders')->get();

        $apartment_orders = [];

        // dd($user_apartments);

        if ($current_user == '1') {
            $apartments = Apartment::limit(5)->get();
        } else {
            $apartments = Apartment::where('user_id', $current_user)->limit(5)->get();

            foreach ($user_apartments as $user_apartment) {

                $current_apartment_id = $user_apartment['id'];

                // dd($user_apartment->orders);
                if ($user_apartment->orders) {
                    foreach ($user_apartment->orders as $order) {
                        // $order = Order::where('apartment_id', $current_apartment_id)->get();
                        //  dd($order);
                        array_push($apartment_orders, $order);
                    };
                }
            }
        }

        return view('admin.dashboard', compact('apartments', 'apartment_orders'));
    }
}
