<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProfileSponsorship;

class DashboardController extends Controller
{
    public function index(){
        $user = Auth::user();

        return view('admin.dashboard', compact('user'));
    }

    public function ciao(){

        $user = Auth::user();
        $profileSponsorshipTable = ProfileSponsorship::all();

        return view('layouts.admin', compact('profileSponsorshipTable', 'user'));
    }
}
