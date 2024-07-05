<?php

namespace App\Http\Controllers\Admin;

use Braintree\Gateway;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Sponsorship;
use App\Models\ProfileSponsorship;
use Illuminate\Support\Facades\Auth;
// use App\Models\ProfileSponsorship; 

class PaymentController extends Controller
{
    protected $gateway;

    public function __construct(Gateway $gateway)
    {
        $this->gateway = $gateway;
    }

    public function index()
    {
        $sponsorships = Sponsorship::all();
        $user = Auth::user();
        $clientToken = $this->gateway->clientToken()->generate();
        return view('payments.index', compact('clientToken', 'sponsorships', 'user'));
    }

    public function checkout(Request $request)
    {
        $formData = $request->all();
        $user = Auth::user();
        $amount = $request->amount;
        $nonce = $request->payment_method_nonce;
        
        $result = $this->gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
                ]
            ]);

        $newProfile = new Profile();
        $newSponsorship = new Sponsorship();
        if ($result->success) {
            // if ($request->has('sponsorhip_id')) {
            //     $newProfile->sponsorships()->attach($formData['sponsorhip_id']);
            // };
            // if ($request->has('profile_id')) {
            //     $newProfile->profiles()->attach($formData['profile_id']);
            // };
            $profileId = $request->input('profile_id');
            $sponsorshipId = $request->input('sponsorship_id');

            // Trova il profilo e la sponsorizzazione
            $profile = Profile::findOrFail($profileId);
            $sponsorship = Sponsorship::findOrFail($sponsorshipId);

            // Crea una nuova riga nella tabella profile_sponsorship
            ProfileSponsorship::create([
                'profile_id' => $profileId,
                'sponsorship_id' => $sponsorshipId
            ]);
            return redirect()->route('admin.payments.success');
        } else {
            return redirect()->route('admin.payments.error')->withErrors('Payment failed.');
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
