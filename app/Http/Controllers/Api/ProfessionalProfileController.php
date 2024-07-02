<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
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
                   ->join('reviews', 'reviews.profile_id', '=', 'profiles.id' )
                   ->join('ratings', 'reviews.profile_id', '=', 'ratings.id' )
                   ->join('specialisations', 'profile_specialisation.specialisation_id', '=', 'specialisations.id')
                   ->join('users', 'profiles.user_id' , '=', 'users.id', )
                   ->select('specialisations.name AS spec_name','specialisations.slug AS spec_slug', 'profile_specialisation.*', 'users.name AS user_name', 'users.slug AS user_slug', 'users.email AS user_mail', 'profiles.*','reviews.*', 'ratings.*')
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
}
