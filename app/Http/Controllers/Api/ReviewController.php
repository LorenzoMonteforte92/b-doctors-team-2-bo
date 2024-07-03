<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Profile;


class ReviewController extends Controller
{
    public function store(Request $request, Profile $profile){
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
}
