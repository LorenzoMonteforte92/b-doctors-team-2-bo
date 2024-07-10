<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProfileSponsorship;
use Illuminate\Support\Carbon;
use App\Models\Review;
use App\Models\UserMessage;




class DashboardController extends Controller
{
    public function index(){
        $user = Auth::user();
        $reviews = Review::where('profile_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
        $chartData = $reviews->sortBy('created_at') // Ordina per data crescente
        ->groupBy(function ($date) {
            return \Carbon\Carbon::parse($date->created_at)->format('Y-m'); // Raggruppa per anno e mese
        })->map(function ($group) {
            // Calcola la media dei rating per ogni gruppo
            $averageRating = $group->avg(function ($review) {
                return $review->rating->score; // Ottieni il valore del rating
            });
            return [
                'date' => $group->first()->created_at->format('Y-m'),
                'average_rating' => $averageRating,
            ];
        })->values(); 
        $messages = UserMessage::where('profile_id', $user->id)
            ->orderBy('date', 'desc')
            ->get();
        $messageChartData = $messages->map(function ($message) {
            return [
                'date' => Carbon::parse($message->date)->format('Y-m'), // Formattiamo la data come 'anno-mese'
                'count' => 1, // Ogni riga rappresenta un messaggio
            ];
        })
        ->groupBy('date') // Raggruppa per 'date'
        ->map(function ($item, $key) {
            return [
                'date' => $key, // Chiave è la data
                'count' => $item->sum('count'), // Somma il conteggio dei messaggi per ogni data
            ];
        })
        ->sortBy('date') // Ordina per data
        ->values(); 

        return view('admin.dashboard', compact('user', 'messageChartData', 'chartData'));
    }

    public function ciao(){

        $user = Auth::user();
        $profileSponsorshipTable = ProfileSponsorship::all();

        return view('layouts.admin', compact('profileSponsorshipTable', 'user'));
    }
}
