<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Specialisation;

class SpecialisationController extends Controller
{
    public function index(){
        $specialisations = Specialisation::all();

        return response()->json([
            'success' => true,
            'results' => $specialisations,
        ]);
    }
}
