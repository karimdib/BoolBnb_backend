<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Braintree\Gateway;
use Illuminate\Http\Request;

class BraintreeController extends Controller
{
    public function token(Request $request){

        $gateway = new Gateway([
            'environment' => 'sandbox',
            'merchantId' => '6f8m48kvhzzdnqjz',
            'publicKey' => 'frghfp9xhh75h59k',
            'privateKey' => '1bcaba7c6a2615544fd3512e236679cb'
        ]);

        $clientToken = $gateway->clientToken()->generate();
        
        return view ('admin.braintree',['token' => $clientToken]);
    }
    
}
// \Braintree\Gateway
