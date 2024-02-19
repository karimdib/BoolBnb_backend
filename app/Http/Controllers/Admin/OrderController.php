<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Apartment;
use App\Models\User;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $current_user = Auth::id();
        $user = User::find($current_user);
        $apartment_orders = [];

        if ($current_user == '1') {
            $orders = Order::paginate(16);
        } else {
            $user_apartments = $user->apartments()->with('orders')->orderBy('id', 'DESC')->get();
            $apartments = Apartment::where('user_id', $current_user)->get();
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
        $date_now = now();
        return view('admin.orders.index', compact('apartment_orders','date_now'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
