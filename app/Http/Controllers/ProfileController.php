<?php
namespace Alumni\Http\Controllers;

use Validator;
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
        $user = Profile::where('uid', $uid)->get();

        // If not exixist profile for this user, redirect it to show profile
        if(count($user) > 0)
        {
            return redirect('/profile/me/show')->withErrors(['msg' => 'Kreirali ste već jedan profil. Ukoliko želite da izmenite, ovde možete uraditi.'])->withSuccess('Uspešno ste kreirali svoj novi profil. Čestitamo!');
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

        // Create profile
        $profile = new Profile;
        $profile->uid = \Auth::user()->id; // rand(25, 120);
        $profile->langcode = 'sr';
        $profile->ime = ucwords($request->input('ime'));
        $profile->prezime = ucwords($request->input('prezime'));
        $profile->slika = $imageName;
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
        $user = TemporaryProfiles::where('uid', $uid)->get();

        // If temporary profile does not exist, check for public profile
        if(count($user) < 1)
        {
            $user = Profile::where('uid', $uid)->get();
        }

        // If not exixist any profile for this user, redirect it to create profile
        if(count($user) < 1){
            return redirect('/profile/me/create')->withErrors(['msg' => 'You does not have a frofile yet. Create it.']);
        }

        // If isset the profile, return view
        return view('profile.self')->with('data', $user);
 
    }

    /**
     * Show the form for editing the profile.
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        // /profile/edit [GET]

        // Get current user id
        $uid = \Auth::user()->id;
        // Get profile for this id
        $profile = Profile::where('uid', $uid)->get();
        return $profile;
        
        // If not exist profile with user id, redirect to the create profile page
        if(!empty($profile)){
            return view('profile.edit')->with('data', $data); 
        }
        else
        {
            return redirect('/profile/create')->with('alert', 'You do not have a profile yet, create it.');;
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
}
