<?php

namespace App\Http\Controllers\Admin;

use Braintree\Gateway;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Sponsorship;
use App\Models\ProfileSponsorship;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
        return view('admin.payments.index', compact('clientToken', 'sponsorships', 'user'));
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

        $profileId = $request->profile_id;
        $sponsorshipId = $request->sponsorhip_id;
        $sponsorshipName = $request->sponsorhip_name;
        $newProfile = new Profile();
        $newSponsorship = new Sponsorship();
        // Calcola start_date e end_date basato sul tipo di sponsorizzazione
        $startDate = Carbon::now();
        
        $endDate = null;
        if ($result->success) {
            if (empty($profileId) || empty($sponsorshipId)) {
                throw new \Exception('Profile ID o Sponsorship ID mancante');
            }
            
            // Trova il profilo e la sponsorizzazione
            $profile = Profile::findOrFail($profileId);
            $sponsorship = Sponsorship::findOrFail($sponsorshipId);
            
            if($sponsorshipName === 'Pacchetto Silver') {
                $endDate = $startDate->addHours(24);
                $startDate = Carbon::now();
            } elseif ($sponsorshipName === 'Pacchetto Gold'){
                $endDate = $startDate->addHours(72);
                $startDate = Carbon::now();
            } elseif ($sponsorshipName === 'Pacchetto Platinum'){
                $endDate = $startDate->addHours(144);
                $startDate = Carbon::now();
            }
            // Crea una nuova riga nella tabella profile_sponsorship
            ProfileSponsorship::create([
                'profile_id' => $profileId,
                'sponsorship_id' => $sponsorshipId,
                'start_date' => $startDate,
                'end_date' => $endDate
            ]);
            return redirect()->route('admin.payments.success');
        } else {
            return redirect()->route('admin.payments.error')->withErrors('Payment failed.');
        }
    }

    public function success()
    {
        return view('admin.payments.success');
    }

    public function error()
    {
        return view('admin.payments.error');
    }
}
