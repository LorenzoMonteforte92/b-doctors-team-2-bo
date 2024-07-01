<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;

class ProfessionalProfileController extends Controller
{
    public function index(){
        $profiles = Profile::with('user','specialisations')->paginate(10);

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
}
