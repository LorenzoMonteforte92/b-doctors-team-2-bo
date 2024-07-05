<?php

namespace App\Http\Controllers\Admin;

use Braintree\Gateway;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    protected $gateway;

    public function __construct(Gateway $gateway)
    {
        $this->gateway = $gateway;
    }

    public function index()
    {
        $clientToken = $this->gateway->clientToken()->generate();
        return view('payments.index', compact('clientToken'));
    }

    public function checkout(Request $request)
    {
        $amount = $request->amount;
        $nonce = $request->payment_method_nonce;

        $result = $this->gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);
        if ($result->success) {
            return redirect()->route('payments.success');
        } else {
            return redirect()->route('payments.error')->withErrors('Payment failed.');
        }
    }

    public function success()
    {
        return view('payments.success');
    }

    public function error()
    {
        return view('payments.error');
    }
}
