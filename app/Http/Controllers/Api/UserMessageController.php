<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserMessage;

class UserMessageController extends Controller
{
    public function store(Request $request){
        $data = $request->all();

       dd($data);
    }
}
