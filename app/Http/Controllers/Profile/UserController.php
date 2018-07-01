<?php

namespace Alumni\Http\Controllers\Profile;

use Alumni\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;

// Models
use Alumni\Profile;
use Alumni\TemporaryProfile;

// use Alumni\Team;
use Alumni\Http\Controllers\Actions\ActionsController;

class UserController extends Controller
{
    /**
     * Call the auth middleweare on start.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Return the create profile form if the profile is not exits.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Get the current users id
        $uid = \Auth::user()->id;

        // Check if profile is exists
        $ac = new ActionsController;
        $profile = $ac->exists($uid);

        // If not exists profile for this user, redirect it to show profile
        if($profile)
        {
            return redirect()->route('user.show')
                ->withErrors([
                    'msg' => 'Kreirali ste već jedan profil. Ukoliko želite da izmenite, ovde možete uraditi.'
                    ]);
        }

        // /profile/create
        $title = __('Kreiraj profil');
        return view('user.create')->with('title', $title);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // /profile [POST]
        $input = $request->all();

        // Validate request
        $ac = new ActionsController;
        $validator = $ac->validateUser($input);

        if ($validator->fails()) {
            return redirect('profile/me/create')
                ->withErrors($validator)
                ->withInput();
        }

        $profile = new TemporaryProfile;
        $profile->uid = \Auth::user()->id;
        $profile->langcode = 'sr';
        $profile->ime = ucwords($request->input('ime'));
        $profile->prezime = ucwords($request->input('prezime'));
        (!empty($request->input('slika'))) ? $profile->slika = $request->input('slika'): 'profile.png';
        $profile->smer = $request->input('smer');
        $profile->nivo_studija = $request->input('nivo_studija');
        $profile->godina_diplomiranja = $request->input('godina_diplomiranja');
        $profile->naziv_firme = empty($request->input('naziv_firme')) ? '/' : $request->input('naziv_firme');
        $profile->radno_mesto = empty($request->input('radno_mesto')) ? '/' : $request->input('radno_mesto');
        $profile->biografija = $request->input('biografija');
        $profile->poruka = empty($request->input('poruka')) ? '' : $request->input('poruka');
        $profile->save();

        return redirect('/profile/me/show')->with('success', 'Uspešno ste kreirali profil. Čim admin prihvati biće vidljiv i ostalima.');
    }

    /**
     * This function display users own profile
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // Get current users id 
        $uid = \Auth::user()->id;

        // Get profile
        $ac = new ActionsController;

         // If isset the profile, return view
         if($profile = $ac->get($uid))
        {
            return view('user.show')
                ->with('profile', $profile);
        }
        
        // If not exists any profile for this user, redirect it to create profile page with message
        return redirect('/profile/me/create')
            ->with([
                'info' => 'Niste još kreirali profil. Popunjavanjem formulara koji sledi možete to uraditi.'
            ]);       
    }

    /**
     * Show the form for editing the profile.
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        // Get current users id 
        $uid = \Auth::user()->id;

        // Get profile
        $ac = new ActionsController;

         // If isset the profile, return view
         
         if($profile = $ac->get($uid))
        {
            $title = 'Izmeni profil';
            return view('user.edit')->with(['profile' => $profile, 'title' => $title]);
        }

        // If not exists any profile for this user, redirect it to create profile
        if(!$profile){
            return redirect('/profile/me/create')->withErrors(['msg' => 'Niste još kreirali profil.']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // /profile/{id} [PUT]
        $input = $request->all();

        // Validate request
        $ac = new ActionsController;
        $validator = $ac->validateUser($input);

        if ($validator->fails())
        {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // Get the current users id
        $uid = \Auth::user()->id;

        // Get profile
        if($ac->isTemporaryProfileExists($uid))
        {
            $profile = $ac->getTemporaryProfile($uid);
        }
        else
        {
            $profile = new TemporaryProfile;
        }

        $profile->uid = $uid;
        $profile->langcode = 'sr';
        $profile->ime = ucwords($request->input('ime'));
        $profile->prezime = ucwords($request->input('prezime'));
        (!empty($request->input('slika'))) ? $profile->slika = $request->input('slika'): 'profile.png';
        $profile->smer = $request->input('smer');
        $profile->nivo_studija = $request->input('nivo_studija');
        $profile->godina_diplomiranja = $request->input('godina_diplomiranja');
        $profile->naziv_firme = empty($request->input('naziv_firme')) ? '/' : $request->input('naziv_firme');
        $profile->radno_mesto = empty($request->input('radno_mesto')) ? '/' : $request->input('radno_mesto');
        $profile->biografija = $request->input('biografija');
        $profile->poruka = empty($request->input('poruka')) ? '' : $request->input('poruka');
        $profile->save();

        return redirect('/profile/me/show')
            ->with('success', 'Uspešno ste ažurirali vaš profil. Čim admin prihvati biće vidljiv i ostalima.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {

        // Get current users id 
        $uid = \Auth::user()->id;

        // Get profile
        $ac = new ActionsController;

        $profile = $ac->getTemporaryProfile($uid);
        $profile->delete();

        return redirect('/')->with('status', 'Obrisali ste vaš profil.');
    }
}
