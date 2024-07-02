<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserMessage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class UserMessageController extends Controller
{
    public function store(Request $request){
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email',
            'object' => 'required|max:255',
            'message' => 'required',
            'accepted_tc' => 'required|boolean|accepted'
        ],
        [
            'accepted_tc.required' => 'You must accept terms and conditions',
            'accepted_tc.accepted' => 'You must accept terms and conditions',
            'name.required' =>  'Inserisci nome e cognome',
            'email.required' =>  'Email obbligatoria',
            'object.required' =>  'Inserisci l\'oggetto della richiesta',
            'message.required' => 'Inserisci qui il tuo messaggio'
        ]);

        // salvataggio dati nel DB
        $newMessage = new UserMessage();
        $newMessage->fill($data);
        $newMessage->date = Carbon::now();

       dd($data);
    }
}
