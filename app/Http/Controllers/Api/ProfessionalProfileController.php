<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\User;
use App\Models\ProfileSponsorship;
use Illuminate\Support\Facades\DB;

class ProfessionalProfileController extends Controller
{
    public function index(){
        $profiles = Profile::with('user','specialisations')->paginate(10);

        // ->paginate(10)

        return response()->json([
            'success' => true,
            'results' => $profiles,
        ]);
    }

    public function show($slug){
        $profile = Profile::where('user_slug', '=', $slug)->with('user','specialisations')->first();
       
        if($profile){
            $apiData = [
                'success' => true,
                'profile' => $profile,
            ];
        } else{
            $apiData = [
                'success' => false,
                'error' => 'nessun profilo trovato a questo indirizzo',
            ];
        }

        return response()->json($apiData);
    }

    public function showBySpec($slug){ 


        $profile = DB::table('profile_specialisation')
                   ->join('profiles', 'profile_specialisation.profile_id','=', 'profiles.id')
                //    ->join('reviews', 'reviews.profile_id', '=', 'profiles.id' )
                //    ->join('ratings', 'reviews.rating_id', '=', 'ratings.id' )
                   ->join('specialisations', 'profile_specialisation.specialisation_id', '=', 'specialisations.id')
                   ->join('users', 'profiles.user_id' , '=', 'users.id', )
                   ->select('specialisations.name AS spec_name','specialisations.slug AS spec_slug', 'profile_specialisation.*', 'users.name AS user_name', 'users.slug AS user_slug', 'users.email AS user_mail', 'profiles.*')
                   ->where('specialisations.slug', '=', $slug)
                   ->get();




        if($profile){
            $apiData = [
                'success' => true,
                'profile' => $profile,
            ];
        } else{
            $apiData = [
                'success' => false,
                'error' => 'nessuna specializzazione trovata a questo indirizzo',
            ];
        }

        return response()->json($apiData);
    }
    public function profileSponsored(){
        $profileSponsored = ProfileSponsorship::all();
        $users = User::all();

        return response()->json([
            'success' => true,
            'results' => [$profileSponsored, $users],
        ]);
    }

    function sponsoredDoctors(){
        
        $sponsored = DB::table('profile_sponsorship')
        ->join('profiles', 'profile_sponsorship.profile_id','=', 'profiles.id')
        ->join('sponsorships', 'profile_sponsorship.sponsorship_id', '=', 'sponsorships.id')
        ->join('users', 'profiles.user_id', '=', 'users.id', )
        ->join('profile_specialisation', 'profiles.id', 'profile_specialisation.profile_id')
        ->join('specialisations', 'profile_specialisation.specialisation_id', '=', 'specialisations.id')
        ->select('sponsorships.name AS spons_name',
        'profile_sponsorship.*', 
        'users.name AS user_name', 
        'users.slug AS user_slug', 
        'users.email AS user_mail', 
        'profiles.id AS profile_id', 
        'profiles.photo', 
        'profiles.telephone_number',
        'profiles.bio',
        'profiles.performance',
        DB::raw('GROUP_CONCAT(DISTINCT specialisations.slug) as specialization_slug'),
        DB::raw('GROUP_CONCAT(DISTINCT specialisations.name) as specialization_name'),)
        ->groupBy(
            'profile_sponsorship.profile_id', 
            'profile_sponsorship.sponsorship_id',
            'profile_sponsorship.start_date',
            'profile_sponsorship.end_date',
            'profiles.id', 
            'profiles.photo', 
            'profiles.telephone_number',
            'profiles.bio',
            'profiles.performance',
            'users.name',
            'users.slug',
            'users.email',
            'sponsorships.name'
        )
        ->get();

        $sponsored = $sponsored->map(function ($item) {
            $item->specialization_slug = explode(',', $item->specialization_slug);
            $item->specialization_name = explode(',', $item->specialization_name);
            return $item;
        });

        return response()->json([
                    'success' => true,
                    'sponsored' => $sponsored
                ]);
    }

    
}
