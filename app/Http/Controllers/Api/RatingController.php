<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rating;
use Illuminate\Support\Facades\Validator;


class RatingController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make(
            $data,
            [
                'score' => 'required|numeric',
            ],
            [
                'score.required' => 'Devi selezionare un voto da 1 a 5.',
            ]
        );
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ]);
        }
        $rating = new Rating();
        $rating->fill($data);
        $rating->save();


        // return
        return response()->json([
            'success' => true,
            'message' => 'Voto salvato correttamente.',
        ]);
    }
}
