<?php
namespace Alumni\Http\Controllers\Profile;

use Validator;
use Alumni\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

// Main controllers
use Alumni\Profile;
use Alumni\User;
use Alumni\TemporaryProfiles;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Get current user id
        $uid = \Auth::user()->id;
        $profile = Profile::where('uid', $uid)->count();
        $temporaryProfile = TemporaryProfiles::where('uid', $uid)->count();

        // If not exixist profile for this user, redirect it to show profile
        if($profile > 0 || $temporaryProfile > 0)
        {
            return redirect('/profile/me/show')->withErrors(['msg' => 'Kreirali ste već jedan profil. Ukoliko želite da izmenite, ovde možete uraditi.']);
        }
        // /profile/create
        $title = 'Kreiraj profil';
        return view('profile.create')->with('title', $title);
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

        $rules =
        [
            'ime' => 'required|string|min:3',
            'prezime' => 'required|string|min:3',
            'slika' => 'mimes:jpeg,jpg,png|max:1999',
            'smer' => 'required',
            'nivo_studija' => 'required',
            'godina_diplomiranja' => 'required|date_format:Y|max:'.date('Y'),
            'biografija' => 'required'
        ];

        $messages =
        [
            'required' => 'Polje :attribute je obavezno!',
            'date_format' => 'Upišite samo godinu diplomiranja.',
            'mimes' => 'Dozvoljeni formati fajla su jpeg, jpg i png.',
        ];

        $validator = Validator::make($input, $rules, $messages);        

        if ($validator->fails()) {
            return redirect('profile/me/create')
                ->withErrors($validator)
                ->withInput();
        }


        if ($request->hasFile('input_img')) {
            $image = $request->file('input_img');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $this->save();
    
            return back()->with('success','Image Upload successfully');
        }

        // Upload image
        if($request->hasFile('slika')){
            $image = $request->file('slika');
            $imageName = $request->input('prezime').'_'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $imageName);
        }
        else
        {
            $imageName = 'profile.png';
        }

        // Create / update profile
        $haveTemporaryProfile = $this->getTemporaryProfile();

        $profile = ($haveTemporaryProfile) ? $haveTemporaryProfile : new TemporaryProfiles;
        $profile->uid = \Auth::user()->id; // rand(25, 120);
        $profile->langcode = 'sr';
        $profile->ime = ucwords($request->input('ime'));
        $profile->prezime = ucwords($request->input('prezime'));
        ($haveTemporaryProfile) ? '' : $profile->slika = $imageName;
        $profile->smer = $request->input('smer');
        $profile->nivo_studija = $request->input('nivo_studija');
        $profile->godina_diplomiranja = $request->input('godina_diplomiranja');
        $profile->naziv_firme = empty($request->input('naziv_firme')) ? '/' : $request->input('naziv_firme');
        $profile->radno_mesto = empty($request->input('radno_mesto')) ? '/' : $request->input('radno_mesto');
        $profile->biografija = $request->input('biografija');
        $profile->poruka = empty($request->input('poruka')) ? '' : $request->input('poruka');
        $profile->save();

        return redirect('/profile/me/show')->with('success', 'Uspešno ste kreirali profil.');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // Get current user id 
        $uid = \Auth::user()->id;
        $profile = TemporaryProfiles::where('uid', $uid)->first();

        // If temporary profile does not exist, check for public profile
        if(count($profile) < 1)
        {
            $profile = Profile::where('uid', $uid)->first();
        }

        // If not exixist any profile for this user, redirect it to create profile
        if(count($profile) < 1){
            return redirect('/profile/me/create')->withErrors(['msg' => 'Niste još kreirali profil.']);
        }

        // If isset the profile, return view
        return view('profile.show')->with('profile', $profile);
    }

    /**
     * Show the form for editing the profile.
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        // /profile/edit [GET]
        $profile = $this->getTemporaryProfile();

        // If temporary profile does not exist, check for public profile
        if(!$profile)
        {
            $profile = $this->getProfile();
        }

        // If not exixist any profile for this user, redirect it to create profile
        if(!$profile){
            return redirect('/profile/me/create')->withErrors(['msg' => 'Niste još kreirali profil.']);
        }

        // If isset the profile, return view
        return view('profile.create')->with(['profile' => $profile, 'title' => 'Izmeni profil']);
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
        $data = 'Update profile';
        return view('profile.update')->with('data', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // /profile/{id} [DELETE]
        return 'Delete profile - '.$id;
    }

    private function getProfile()
    {
        // Get current user id
        $uid = \Auth::user()->id;
        $profile = Profile::where('uid', $uid)->first();

        return (count($profile) < 1) ? false : $profile;
    }

    private function getTemporaryProfile()
    {
        // Get current user id
        $uid = \Auth::user()->id;
        $profile = TemporaryProfiles::where('uid', $uid)->first();

        return (count($profile) < 1) ? false : $profile;
    }

}
