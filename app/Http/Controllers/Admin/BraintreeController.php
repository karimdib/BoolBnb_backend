<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Braintree\Gateway;
use Braintree\Configuration;
use Illuminate\Http\Request;

class BraintreeController extends Controller
{
    public function showCheckout(Request $request){

        // return view('admin.braintree');

        $gateway = new Gateway([
            'environment' => 'sandbox',
            'merchantId' => '6f8m48kvhzzdnqjz',
            'publicKey' => '27h635y22h3kfjhy',
            'privateKey' => '935dd3c3db771d5dc1a6193708cc60fe'
        ]);

        $clientToken = $gateway->clientToken()->generate();
        
        return view ('admin.braintree',['token' => $clientToken]);
    }
    public function processPayment(Request $request){
        $nonce = $request->input('payment_method_nonce');
        
        $gateway = new Gateway([
            'environment' => 'sandbox',
            'merchantId' => '6f8m48kvhzzdnqjz',
            'publicKey' => '27h635y22h3kfjhy',
            'privateKey' => '935dd3c3db771d5dc1a6193708cc60fe'
        ]);

        $environment = new Configuration([

            'environment' => 'sandbox',
            'merchantId' => '6f8m48kvhzzdnqjz',
            'publicKey' => '27h635y22h3kfjhy',
            'privateKey' => '935dd3c3db771d5dc1a6193708cc60fe'
        ]);

        dd($environment);
        // dd(\Braintree\Configuration::environment());
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
