<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request){
        $data = $request->all();

       dd($data);

        // return response()->json([
        //     'success' => true
        // ]);
    }
}
