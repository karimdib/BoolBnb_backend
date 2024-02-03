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
            'merchantId' => '5b9r528tbqdcg9nx',
            'publicKey' => 'vr8xdtzqmvtdt8q6',
            'privateKey' => '708e848bf2e4b30cf13e0990755132d1'
        ]);

        $clientToken = $gateway->clientToken()->generate();

        return view('admin.braintree', ['token' => $clientToken]);
    }

    public function processPayment(Request $request)
    {
        //$nonce = $request->input('payment_method_nonce');
        $payMethod = $request->input('pay_method');
        if ($payMethod === '1') {
            $amount = 2.99;
        } elseif ($payMethod === '2') {
            $amount = 5.99;
        } elseif ($payMethod === '3') {
            $amount = 9.99;
        } else {
            return 'devi scegliere un opzione';
        }
        $gateway = new Gateway([
            'environment' => 'sandbox',
            'merchantId' => '5b9r528tbqdcg9nx',
            'publicKey' => 'vr8xdtzqmvtdt8q6',
            'privateKey' => '708e848bf2e4b30cf13e0990755132d1'
        ]);

        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => 'fake-valid-nonce',
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
