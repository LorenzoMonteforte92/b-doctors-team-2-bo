<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Models\Review;
use App\Models\Rating;
use App\Models\Message;
use App\Models\Specialisation;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


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
        $user = Auth::user();

        return view('admin.profiles.index', 'layouts.admin', compact('reviews', 'ratings', 'messages', 'profiles', 'user'));
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
        $validate= $request->validate([
            'photo' => 'nullable|file|mimes:png,jpg,jpeg|max:2044',
            'telephone_number' => 'required|string|max:15',
            'address' => 'required',
            'curriculum_vitae' => 'nullable|file|mimes:png,jpg,jpeg|max:2044',
            'specialisations' => 'required',
            'bio' => 'nullable|string|min:10',
            'performance' => 'nullable|string|min:10',
        ],
        [
            'photo.mimes' => 'il file deve essere png, jpg o jpeg',
            'photo.max' => 'il file non deve superare i 2mb', 
            'telephone_number.required' => 'Numero di telefono obbligatorio', 
            'telephone_number.max' => 'il numero di telefono deve contenere massimo 15 cifre',
            'address' => 'indirizzo obbligatorio',
            'curriculum_vitae.mimes' => 'il file deve essere png, jpg o jpeg',
            'curriculum_vitae.max' => 'il file non deve superare i 2mb',
            'specialisations.required' => 'devi selezionare almeno una specializzazione',
            'bio.min' => 'Bio non valida: deve contenere almeno 10 caratteri',
            'performance.min' => 'Descrizione prestazioni non valida: deve contenere almeno 10 caratteri',
        ]
     
    );
        
        $profileData = $request->all();

        if ($request->hasFile('photo')) {
            $img_path = Storage::disk('public')->put('projects_images', $profileData['photo']);
            $profileData['photo'] = $img_path;
        }
        if ($request->hasFile('curriculum_vitae')) {
            $img_path = Storage::disk('public')->put('projects_images', $profileData['curriculum_vitae']);
            $profileData['curriculum_vitae'] = $img_path;
        }
        
        $newProfile = new Profile();
        $newProfile->fill($profileData);
        $newProfile->save();

        return redirect()->route('admin.profiles.show', ['profile' => $newProfile->id])->with('message','Nuovo profilo creato con successo');

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
        $user = Auth::user();
        return view('admin.profiles.show', compact('profile', 'user'));
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
        $validate = $request->validate([
            'photo' => 'nullable|file|mimes:png,jpg,jpeg|max:2044',
            'telephone_number' => 'required|string|max:15',
            'address' => 'required',
            'curriculum_vitae' => 'nullable|file|mimes:png,jpg,jpeg|max:2044',
            'specialisations' => 'required',
            'bio' => 'nullable|string|min:10',
            'performance' => 'nullable|string|min:10',
            'visibility' => 'boolean'

        ],
        [
            'photo.mimes' => 'il file deve essere png, jpg o jpeg',
            'photo.max' => 'il file non deve superare i 2mb', 
            'telephone_number.required' => 'Numero di telefono obbligatorio', 
            'telephone_number.max' => 'il numero di telefono deve contenere massimo 15 cifre',
            'address' => 'indirizzo obbligatorio',
            'curriculum_vitae.mimes' => 'il file deve essere png, jpg o jpeg',
            'curriculum_vitae.max' => 'il file non deve superare i 2mb',
            'specialisations.required' => 'devi selezionare almeno una specializzazione',
            'bio.min' => 'Bio non valida: deve contenere almeno 10 caratteri',
            'performance.min' => 'Descrizione prestazioni non valida: deve contenere almeno 10 caratteri',
         ]
    );
            //Campi Imput per richiamare l'edit //
            // $profile->photo = $request->input('photo');
            // $profile->telephone_number = $request->input('telephone_number');
            // $profile->bio = $request->input('bio');
            // $profile->performance = $request->input('performance');
            $form = $request->all();
            if ($request->hasFile('photo')) {
                if ($profile->photo) {
                    Storage::delete($profile->photo);
                }
                $img_path = Storage::disk('public')->put('projects_images', $form['photo']);
                $form['photo'] = $img_path;
            }
            if ($request->hasFile('curriculum_vitae')) {
                if ($profile->curriculum_vitae) {
                    Storage::delete($profile->curriculum_vitae);
                }
                $img_path = Storage::disk('public')->put('projects_images', $form['curriculum_vitae']);
                $form['curriculum_vitae'] = $img_path;
            }
        
    
            $profile->update($form);
    
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
        
        if ($profile->photo) {
            Storage::delete($profile->photo);
        }
        if ($profile->curriculum_vitae) {
            Storage::delete($profile->curriculum_vitae);
        }
        $profile->delete();

        return redirect()->route('admin.profiles.index')->with('message', 'Profile successfully deleted.');
    }
}