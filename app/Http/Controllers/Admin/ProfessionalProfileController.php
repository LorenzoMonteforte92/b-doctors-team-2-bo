<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Rating;
use App\Models\Message;
use App\Models\Specialisation;
use App\Models\Profile;

class ProfessionalProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews = Review::all();
        $ratings = Rating::all();
        $messages = Message::all();
        $profiles = Profile::all();

        return view('admin.profiles.index', compact('reviews', 'ratings', 'messages', 'profiles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $specialisations = Specialisation::all();
        return view('admin.profiles.create', compact('specialisations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'nullable|url',
            'telephone_number' => 'required|string|max:15',
            'curriculum_vitae' => 'nullable|string',
            'bio' => 'nullable|string',
            'performance' => 'nullable|string',
        ]);
        $profileData = $request->all();
        $newProfile = new Profile();
        $newProfile->fill($profileData);
        $newProfile->save();

        return redirect()->route('admin.profiles.show', ['profile' => $newProfile->id]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile = Profile::findOrFail($id);
        return view('admin.profiles.show', compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        return view('admin.profiles.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        $request->validate([
            'photo' => 'nullable|url',
            'telephone_number' => 'required|string|max:15',
            'curriculum_vitae' => 'nullable|file|mimes:pdf,doc,docx',
            'bio' => 'nullable|string',
            'performance' => 'nullable|string',
            'visibility' => 'boolean'

        ]);
            //Campi Imput per richiamare l'edit //
            $profile->photo = $request->input('photo');
            $profile->telephone_number = $request->input('telephone_number');
            $profile->bio = $request->input('bio');
            $profile->performance = $request->input('performance');
        
    
            $profile->save();
    
        return redirect()->route('admin.profiles.show', ['profile' => $profile->id])->with('message', 'Profilo aggiornato con successo.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profile = Profile::findOrFail($id);
        $profile->delete();

        return redirect()->route('admin.profiles.index')->with('message', 'Profile successfully deleted.');
    }
}