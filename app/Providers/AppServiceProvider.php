<?php

namespace App\Providers;

use App\Models\ProfileSponsorship;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $profileSponsor = DB::table('profile_sponsorship')
        ->join('profiles', 'profile_sponsorship.profile_id', '=', 'profiles.id' )
        ->select('profiles.id AS profile_id', 'profile_sponsorship.end_date')->get();

        View::share('profileSponsor', $profileSponsor);
    }
}
