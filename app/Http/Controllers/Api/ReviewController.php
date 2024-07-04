<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Profile;
use App\Models\Rating;
use Illuminate\Support\Facades\DB;
use App\Services\V1\SpecAndRatingQuery;


class ReviewController extends Controller
{
    public function store(Request $request){
        $data = $request->all();

        

        // validazione name e description
        $validator = Validator::make($data, [
            'name' => 'string|max:255',
            'description' => 'required|string|max:255',
        ],
        [
            'description.required' => 'Il campo descrizione è obbligatorio',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        // salvo i dati nel DB
        $review = new Review();
        $review->fill($data);
        $review->save();

    

        return response()->json([
            'success' => true,
            ]);

           

    }

    public function index(){
        $reviews = DB::table('reviews')
        ->select('profiles.id AS profile_id','users.name', 'users.email', 'users.slug', DB::raw('ROUND(AVG(score)) AS average_score'))
        ->join('ratings', 'reviews.rating_id', '=', 'ratings.id'  )
        ->join('profiles', 'reviews.profile_id', '=', 'profiles.id' )
        ->join('users', 'profiles.user_id', '=', 'users.id')
        ->groupBy('profiles.id')
        ->get();

        return response()->json([
            'success' => true,
            'reviews' => $reviews,
        ]);
    }

    public function countReviews(){
        $reviewCount = DB::table('reviews')
        ->select('profiles.id AS profile_id', 'users.name', 'users.email', 'users.slug', DB::raw('COUNT(reviews.id) AS review_count'))
        ->join('profiles', 'reviews.profile_id', '=', 'profiles.id' )
        ->join('users', 'profiles.user_id', '=', 'users.id')
        ->groupBy('profiles.id')
        ->get();

        return response()->json([
            'success' => true,
            'results' => $reviewCount,
        ]);
    }

    // public function filterBySpecAndRating(Request $request){
    //     // nuovo oggetto per la query
    //     $filter = new SpecAndRatingQuery();

    //     // oggetti da cui si costruisce la struttura della query come array di array [['column', 'operator', 'value' ]]
    //     $queryItems = $filter->transform($request); 

    //     if(count($queryItems) == 0){
            
    //     $reviewCount = DB::table('reviews')
    //         ->select('profiles.id AS profile_id', 'users.name', 'users.email', 'users.slug', DB::raw('COUNT(reviews.id) AS review_count'))
    //         ->join('profiles', 'reviews.profile_id', '=', 'profiles.id' )
    //         ->join('users', 'profiles.user_id', '=', 'users.id')
    //         ->groupBy('profiles.id')
    //         ->get();

    //     } else{

    //     $reviewCount = DB::table('reviews')
    //         ->select('profiles.id AS profile_id', 'users.name', 'users.email', 'users.slug', DB::raw('COUNT(reviews.id) AS review_count'))
    //         ->join('profiles', 'reviews.profile_id', '=', 'profiles.id' )
    //         ->join('users', 'profiles.user_id', '=', 'users.id')
    //         ->groupBy('profiles.id')
    //         ->where($queryItems)
    //         ->get();
    //     };

    //     dd($request);

    //     return response()->json([
    //         'success' => true,
    //         'results' => $reviewCount,
    //     ]);

    // }

    public function filterResults(Request $request) { 
       
        $categories = $request->input(); // Filtra i dati in base alle categorie selezionate 
        
        $filteredResults = Review::select('reviews.*', 'profiles.id AS profile_id','specialisations.*', 'profiles.user_id', 'users.name', 'users.email', 'users.slug', 'ratings.score AS rating_score')
        ->join('ratings', 'reviews.rating_id', '=', 'ratings.id')
        ->join('profiles', 'reviews.profile_id', '=', 'profiles.id')
        ->join('users', 'profiles.user_id', '=', 'users.id')
        ->join('profile_specialisation', 'profiles.id', '=', 'profile_specialisation.profile_id')
        ->join('specialisations', 'profile_specialisation.specialisation_id', '=', 'specialisations.id')
        ->where('specialisations.slug', $categories)
        // ->withCount('reviews')
        ->withAvg('rating as avg_rating', 'score')
        ->get();

     

        return response()->json([
            'success' => true,
            'results' => $filteredResults,
        ]);

        
    }
}
