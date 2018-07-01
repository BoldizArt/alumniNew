<?php
/**
 * @file
 * Contains Alumni\Http\Controllers\Profile\AdminController;
 */
namespace Alumni\Http\Controllers\Profile;

use Illuminate\Http\Request;
use Alumni\Http\Controllers\Controller;
use Alumni\TemporaryProfile;

class AdminController extends Controller
{
    protected $temporary;

    /**
     * Call the auth middleweare on start.
     *
     * @return void
     */
    public function __construct(TemporaryProfile $temporary)
    {
        $this->middleware('auth');
        $this->middleware('role');
        
        // Dependency innjection
        $this->temporary = $temporary;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // /profile
        $title = __('Novi studenti');
        $data = $this->temporary::orderBy('ime', 'asc')->paginate(10);
        return view('admin.index')->with(['data' => $data, 'title' => $title]);
    }

    /**
     * Return the count of new users.
     *
     * @return \Illuminate\Http\Response
     */
    public function newUsers()
    {
        $count = $this->temporary::count();
        return $count;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile = $this->temporary::find($id);
        if(count($profile) < 1)
        {
            return redirect()->back()->withErrors(['msg' => 'Can not find this user.']);
        }
        return view('admin.show')->with('profile', $profile);
    }
}
