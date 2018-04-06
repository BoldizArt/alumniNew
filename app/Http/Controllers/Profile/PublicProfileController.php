<?php
namespace Alumni\Http\Controllers\Profile;

use Alumni\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Alumni\Profile;

class PublicProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // /profile
        $data = Profile::orderBy('ime', 'asc')->paginate(10);
        return view('profile.index')->with('data', $data);
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
        return view('profile.show')->with('profile', $profile);
    }
}
