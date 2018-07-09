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
        $data = $this->profile::where('tip_profila', 'student')
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
        $profiles = $this->profile::where('tip_profila', 'student')->find($id);

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

    /**
     * Display team members.
     *
     * @return \Illuminate\Http\Response
     */
    public function team()
    {
        $title = 'Alumni tim';
        $all =  $this->profile::whereNotIn('tip_profila', ['student'])
            ->orderBy('ime', 'asc')
            ->get();

        // Sort team members by profile type. 
        $teamArray = [];
        foreach ($all as $key => $value) {
            $teamArray[$value->tip_profila][] = $value;
        }

        // Create object from array.
        $team = json_decode(json_encode($teamArray), FALSE);

        return view('public.team')->with(['team' => $team, 'title' => $title]);
    }

    /**
     * Show team member by id.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function teamMember($id)
    {
        $member = $this->profile::whereNotIn('tip_profila', ['student'])->find($id);

        if(count($member) < 1){
            return redirect()->back()->withErrors(['msg' => 'Ne možemo da nađemo ovaj korisnik.']);
        }

        return view('public.team-member')->with('profile', $member);
    }

}
