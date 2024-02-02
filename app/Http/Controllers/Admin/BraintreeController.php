<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Braintree\Gateway;
use Illuminate\Http\Request;

class BraintreeController extends Controller
{
    public function showCheckout(Request $request)
    {
        $gateway = new Gateway([
            'environment' => 'sandbox',
            'merchantId' => '6f8m48kvhzzdnqjz',
            'publicKey' => '27h635y22h3kfjhy',
            'privateKey' => '935dd3c3db771d5dc1a6193708cc60fe'
        ]);

        $clientToken = $gateway->clientToken()->generate();

        return view('admin.braintree', ['token' => $clientToken]);
    }

    public function processPayment(Request $request)
    {
        $nonce = $request->input('payment_method_nonce');

        $gateway = new Gateway([
            'environment' => 'sandbox',
            'merchantId' => '6f8m48kvhzzdnqjz',
            'publicKey' => '27h635y22h3kfjhy',
            'privateKey' => '935dd3c3db771d5dc1a6193708cc60fe'
        ]);

        $result = $gateway->transaction()->sale([
            'amount' => '10.00',
            'paymentMethodNonce' => 'mastarcard',
            'options' => [
                'submitForSettlement' => true,
            ],
        ]);
        dd($result);
        if ($result->success) {
            return "Pagamento completato con successo!";
        } else {
            return "Errore durante il pagamento: " . $result->message;
        }
    }
}
