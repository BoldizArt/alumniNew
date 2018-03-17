<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
// Main controllers
use App\Profile;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // /profile
        $data = Profile::all();
        // Profile::orderBy('ime', 'asc')->get();
        // Profile::where('ime, 'Boldižar')->get();
        // Profile::orderBy('ime', 'asc')->take(1)->get();
        // Profile::orderBy('ime', 'asc')->paginate(1);
        // return view('profile.index')->with('data', $data);

        // {{ $profiles->links }} //

        return response()->json([
            //'body' => view('profile.index')->with('data', $data)->render(),
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // /profile/create
        $data = 'Create profile';
        return view('profile.create')->with('data', $data);
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
        return 'Store profile data';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // /profile/{id} [GET]
        $info = [
            'id' => $id,
            'ime' => 'Boldižar',
            'prezime' => 'Santo',
            'smer' => 'Odevno inženjerstvo',
            'nivostudija' => 'Master studije',
            'godinadipl' => '2017',
            'nazivfirme' => 'BoldizArt Webdesign',
            'radnomesto' => 'Webdesigner',
            'bio' => 'Lorem ipsum dolor sit amet,sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, At vero eos et accusam et justo duo dolores et ea rebum. Lorem ipsum dolor sit amet, no sea takimata sanctus est Lorem ipsum dolor sit amet. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. no sea takimata sanctus est Lorem ipsum dolor sit amet. no sea takimata sanctus est Lorem ipsum dolor sit amet. sed diam voluptua.',
            'poruka' => 'Uspešni ljudi uvek traže mogućnosti da pomognu drugima. Neuspešni uvek pitaju: Šta ja imam od toga? Vi ste jedini koji možete da odlučite kakva ćete biti osoba, niko više!'
        ];

        return view('profile.show')->with('info', $info);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // /profile/{id}/edit [GET]
        $data = 'Edit profile';
        return view('profile.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
