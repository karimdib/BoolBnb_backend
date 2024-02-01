<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Braintree\Gateway;
use Illuminate\Http\Request;

class BraintreeController extends Controller
{
    public function showCheckout(Request $request){

        return view('admin.braintree');

        // $gateway = new Gateway([
        //     'environment' => 'sandbox',
        //     'merchantId' => '6f8m48kvhzzdnqjz',
        //     'publicKey' => 'frghfp9xhh75h59k',
        //     'privateKey' => '1bcaba7c6a2615544fd3512e236679cb'
        // ]);

        // $clientToken = $gateway->clientToken()->generate();
        
        // return view ('admin.braintree',['token' => $clientToken]);
    }
    public function processPayment(Request $request){
        $nonce = $request->input('payment_method_nonce');

        $result = \Braintree\Transaction::sale([
            'amount' => '10.00',
            'paymentMethodNonce' => $nonce,
            'options' => [
            'submitForSettlement' => true,
            ],
        ]);

        if ($result->success) {
            return "Pagamento completato con successo!";
        } else {
            return "Errore durante il pagamento: " . $result->message;
        }
    }
    
}
// \Braintree\Gateway
