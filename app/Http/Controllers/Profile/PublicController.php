<?php

namespace Alumni\Http\Controllers\Profile;

use Alumni\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Alumni\Profile;

class PublicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // /profile
        $title = __('Naši studenti');
        $data = Profile::orderBy('ime', 'asc')->paginate(10);
        return view('public.index')->with(['data' => $data, 'title' => $title]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile = Profile::find($id);
        if(count($profile) < 1){
            return redirect()->back()->withErrors(['msg' => 'Can not find this user.']);
        }
        return view('public.show')->with('profile', $profile);
    }

    /**
     * Display a contact form.
     *
     * @return \Illuminate\Http\Response
     */
    public function news()
    {
        return view('public.news')->with('title', 'Događaji');
    }

    /**
     * Display the news.
     *
     * @return \Illuminate\Http\Response
     */
    public function contact()
    {
        return view('public.contact')->with('title', 'Kontakt form');
    }

}
