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
            'results' => $reviews,
        ]);
    }

    public function countReviews(){
        $reviewCount = DB::table('reviews')
        ->select(DB::raw('COUNT(reviews.id) AS review_count'))
        ->join('profiles', 'reviews.profile_id', '=', 'profiles.id' )
        ->groupBy('profiles.id')
        ->get();

        return response()->json([
            'success' => true,
            'results' => $reviewCount,
        ]);
    }
}
