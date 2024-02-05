<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Order;
use App\Models\Sponsorship;
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
            $apartmentId = $request->input('apartment_id');
            $sponsorshipId = Sponsorship::where('cost', $amount)->value('id');

            $date_start = now();
            if ($sponsorshipId === 1) {
                $date_end = now()->addDay();
            } elseif ($sponsorshipId === 2) {
                $date_end = now()->addDay(2);
            } else {
                $date_end = now()->addDay(6);
            }
            $new_order = Order::create([
                'sponsorship_id' => $sponsorshipId,
                'apartment_id' => $apartmentId,
                'date_start' => $date_start,
                'date_end' => $date_end,
            ]);
            return "Pagamento completato con successo!" . $new_order;
        } else {
            return "Errore durante il pagamento: " . $result->message;
        }
    }
}
