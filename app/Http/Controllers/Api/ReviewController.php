<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Profile;
use App\Models\Rating;
use App\Models\Specialisation;
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

    public function filterProfiles(Request $request)
{
    $specializationSlug = $request->input('specialization_slug');
    $minReviews = $request->input('min_reviews');
    $minRating = $request->input('min_rating');

    if ($specializationSlug) {
        $specializationSlug = explode(',', $specializationSlug);
    }
    $profiles = Profile::with(['specialisations', 'reviews'])
        ->leftJoin('profile_specialisation', 'profiles.id', '=', 'profile_specialisation.profile_id')
        ->leftJoin('specialisations', 'profile_specialisation.specialisation_id', '=', 'specialisations.id')
        ->leftJoin('users', 'profiles.user_id', '=', 'users.id')
        ->leftJoin('reviews', 'profiles.id', '=', 'reviews.profile_id')
        ->leftJoin('ratings', 'reviews.rating_id', '=', 'ratings.id')
        ->select(
            'profiles.id',
            'profiles.photo',
            'users.name as user_name',
            'users.slug as user_slug',
            'users.email as user_mail',
            DB::raw('GROUP_CONCAT(DISTINCT specialisations.slug) as specialization_slug'),
            DB::raw('COUNT(reviews.id) as review_count'),
            DB::raw('CAST(ROUND(AVG(ratings.score), 1) AS DECIMAL(1,0)) as average_score')
            
        )
        ->groupBy(
            'profiles.id',
            'users.name',
            'users.email',
        );
        if ($specializationSlug) {
            $profiles->whereHas('specialisations', function ($query) use ($specializationSlug) {
                $query->whereIn('slug', $specializationSlug);
            });
        }
        if ($minReviews) {
            $profiles->having('review_count', '>=', $minReviews);
        }
    
        if ($minRating) {
            $profiles->having('average_score', '>=', $minRating);
        }
        $profiles = $profiles->get();
        $profiles->transform(function ($profile) {
            $profile->average_score = floatval($profile->average_score);
            return $profile;
        });
        if ($minRating) {
            $profiles->having('average_score', '>=', $minRating);
        }
    return $profiles;
}
public function apiFilterProfiles(Request $request)
{
    $profiles = $this->filterProfiles($request);
    return response()->json($profiles);
}


// public function filterProfiles(Request $request)
// {
//     $specialisationSlugs = $request->input('specialisations', []);
//     $minReviews = $request->input('min_reviews', 0);
//     $minAverageScore = $request->input('min_average_score', 0);

//     // Recupera gli ID delle specializzazioni basati sugli slug
//     $specialisationIds = Specialisation::whereIn('slug', $specialisationSlugs)->pluck('id')->toArray();

//     // Ottieni i profili con i criteri richiesti
//     $profiles = Profile::select('profiles.*', 'users.name as user_name', 'users.email as user_email')
//         ->with(['reviews', 'specialisations'])
//         ->join('profile_specialisation', 'profiles.id', '=', 'profile_specialisation.profile_id')
//         ->join('specialisations', 'profile_specialisation.specialisation_id', '=', 'specialisations.id')
//         ->whereIn('specialisations.id', $specialisationIds)
//         ->join('reviews', 'profiles.id', '=', 'reviews.profile_id')
//         ->join('ratings', 'reviews.rating_id', '=', 'ratings.id') // Correggi la colonna qui
//         ->join('users', 'profiles.user_id', '=', 'users.id') // Aggiungi la join con la tabella users
//         ->select(
//             'profiles.*',
//             'users.name as user_name',
//             'users.email as user_email',
//             DB::raw('count(reviews.id) as reviews_count'),
//             DB::raw('round(avg(ratings.score), 1) as average_score')
//         )
//         ->groupBy(
//             'profiles.id',
//             'users.name',
//             'users.email'
    
//         )
//         ->having('reviews_count', '>=', $minReviews)
//         ->having('average_score', '>=', $minAverageScore)
//         ->get();

//     return response()->json($profiles);
// }

}


