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
            'merchantId' => 'wpp3h3gwk9k8mxrj',
            'publicKey' => '4mnggd723mb5znrv',
            'privateKey' => 'f2776ff73707c128646a87ea37111c89'
        ]);

        $clientToken = $gateway->clientToken()->generate();

        return view('admin.braintree', ['token' => $clientToken]);
    }

    public function processPayment(Request $request)
    {
        //$nonce = $request->input('payment_method_nonce');
        $payMethod = $request->input('pay_method');
        $cardholder_name = $request->input('cardholder_name');
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
            'merchantId' => 'wpp3h3gwk9k8mxrj',
            'publicKey' => '4mnggd723mb5znrv',
            'privateKey' => 'f2776ff73707c128646a87ea37111c89'
        ]);

        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => 'fake-valid-nonce',
            'customer' => [
                'firstName' => $cardholder_name,
            ],
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
