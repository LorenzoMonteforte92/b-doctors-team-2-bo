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

    public function silver()
    {
        $sponsorships = Sponsorship::all();
        $user = Auth::user();
        $clientToken = $this->gateway->clientToken()->generate();
        return view('admin.payments.silver', compact('clientToken', 'sponsorships', 'user'));
    }

    public function gold()
    {
        $sponsorships = Sponsorship::all();
        $user = Auth::user();
        $clientToken = $this->gateway->clientToken()->generate();
        return view('admin.payments.gold', compact('clientToken', 'sponsorships', 'user'));
    }

    public function platinum()
    {
        $sponsorships = Sponsorship::all();
        $user = Auth::user();
        $clientToken = $this->gateway->clientToken()->generate();
        return view('admin.payments.platinum', compact('clientToken', 'sponsorships', 'user'));
    }

    public function checkout(Request $request)
    {
        $formData = $request->all();
        $user = Auth::user();
        $amount = $request->amount;
        $nonce = $request->payment_method_nonce;

        // Esegui la transazione Braintree
        $result = $this->gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
            'submitForSettlement' => true
            ]
        ]);

        $profileId = $request->profile_id;
        $sponsorshipId = $request->sponsorship_id; // Corretto
        $sponsorshipName = $request->sponsorship_name; // Corretto
        
        // Calcola start_date e end_date basato sul tipo di sponsorizzazione
        $startDate = Carbon::now();
        
        if ($result->success) {
            if (empty($profileId) || empty($sponsorshipId)) {
                throw new \Exception('Profile ID o Sponsorship ID mancante');
            }
            
            // Trova il profilo e la sponsorizzazione
            $profile = Profile::findOrFail($profileId);
            $sponsorship = Sponsorship::findOrFail($sponsorshipId);
     
            if(ProfileSponsorship::where('profile_id', $profileId)->exists() ){

                $profileSponsorship = ProfileSponsorship::where('profile_id', $profileId)
                ->first();

            
                if ($sponsorshipName === 'Pacchetto Silver') {
                    $newEndDate = Carbon::parse($profileSponsorship->end_date)->addHours(24);
                } elseif ($sponsorshipName === 'Pacchetto Gold') {
                    $newEndDate = Carbon::parse($profileSponsorship->end_date)->addHours(72);
                } elseif ($sponsorshipName === 'Pacchetto Platinum') {
                    $newEndDate = Carbon::parse($profileSponsorship->end_date)->addHours(144);
                }

                $profileSponsorship->where('profile_id', $profileId )->update([
                    'sponsorship_id' => $sponsorshipId,
                    'start_date' => Carbon::now(),
                    'end_date' => $newEndDate
                ]);
        
        } else {
            
            if($sponsorshipName === 'Pacchetto Silver') {
                $endDate = $startDate->addHours(24);
            } elseif ($sponsorshipName === 'Pacchetto Gold'){
                $endDate = $startDate->addHours(72);
            } elseif ($sponsorshipName === 'Pacchetto Platinum'){
                $endDate = $startDate->addHours(144);
            }

            // Crea una nuova riga nella tabella profile_sponsorship
        ProfileSponsorship::create([
            'profile_id' => $profileId,
            'sponsorship_id' => $sponsorshipId,
            'start_date' => Carbon::now(),
            'end_date' => $endDate
        ]);
        }
            
       
            

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