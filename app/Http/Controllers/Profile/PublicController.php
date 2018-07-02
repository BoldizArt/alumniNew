<?php

namespace Alumni\Http\Controllers\Profile;

use Alumni\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Alumni\Profile;

class PublicController extends Controller
{
    protected $profile;

    /**
     * Dependency innjection with constructor method.
     */
    public function __construct(Profile $profile)
    {
        $this->profile = $profile;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // /profile
        $title = __('Naši studenti');
        $data = $this->profile::where('profile_type', 'student')
        ->orderBy('ime', 'asc')
        ->paginate(10);
        
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
        $profiles = $this->profile::find($id);

        if(count($profiles) < 1){
            return redirect()->back()->withErrors(['msg' => 'Can not find this user.']);
        }

        return view('public.show')->with('profile', $profiles);
    }

    /**
     * Display a contact form.
     *
     * @return \Illuminate\Http\Response
     */
    public function news()
    {
        $title = __('Događaji');

        return view('public.news')->with('title', $title);
    }

    /**
     * Display the news.
     *
     * @return \Illuminate\Http\Response
     */
    public function contact()
    {
        $title = __('Kontaktirajte nas');

        return view('public.contact')->with('title', $title);
    }

}
