<?php
namespace Alumni\Http\Controllers;

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
        $data = Profile::all();
        // Profile::orderBy('ime', 'asc')->get();
        // Profile::where('ime', 'Boldižar')->get();
        // Profile::orderBy('ime', 'asc')->take(1)->get();
        // Profile::orderBy('ime', 'asc')->paginate(1);
        // return view('profile.index')->with('data', $data);

        // {{ $profiles->links }} //
        return view('profile.index')->with('data', $data);
        return response()->json([
            //'body' => view('profile.index')->with('data', $data)->render(),
            'data' => $data,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Profile::find($id);
        if(count($user) < 1){
            return redirect()->back()->withErrors(['msg' => 'Can not find this user.']);
        }
        return view('profile.show')->with('data', $user);
    }
}
