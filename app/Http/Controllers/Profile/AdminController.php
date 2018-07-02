<?php
/**
 * @file
 * Contains Alumni\Http\Controllers\Profile\AdminController;
 */
namespace Alumni\Http\Controllers\Profile;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Alumni\Http\Controllers\Controller;
use Auth;
use Alumni\Profile;
use Alumni\TemporaryProfile;
use Alumni\Http\Controllers\Actions\ActionsController;

class AdminController extends Controller
{
    /**
     * Variables
     */
    protected $action;
    protected $profile;
    protected $auth;
    protected $user;
    protected $temporary;
    protected $statusArray = [  
        'created', 
        'updated'
    ];

    /**
     * Call the auth and role middleweare on start.
     *
     * @return void
     */
    public function __construct(ActionsController $action, TemporaryProfile $temporary, Profile $profile, Auth $auth)
    {
        $this->middleware('auth');
        $this->middleware('role');
        
        // Dependency innjection
        $this->temporary = $temporary;
        $this->action = $action;
        $this->temporary = $temporary;
        $this->profile = $profile;
        $this->auth = $auth;

        // Get current user id and set in $uid variable.
        $this->middleware(function ($request, $next) {
            $this->user = $this->auth::user();

            return $next($request);
        });
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
        $data = $this->temporary::whereIn('status', $this->statusArray)
            ->orderBy('ime', 'asc')
            ->paginate(10);

        return view('admin.index')->with(['data' => $data, 'title' => $title]);
    }

    /**
     * Return the count of new users.
     *
     * @return \Illuminate\Http\Response
     */
    public function newUsers()
    {
        $count = $this->temporary::whereIn('status', $this->statusArray)->count();

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
        
        if(count($profile) < 1) {
            return redirect()->back()->withErrors(['msg' => 'Can not find this user.']);
        }

        return view('public.show')->with('profile', $profile);
    }

    /**
     * Store a accepted user in profile db.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function accept(Request $request)
    {
        if ($request->post('pid')) { 
            $pid = $request->post('pid');
            $status = $request->post('status');
            $komentar = $request->post('komentar');

            // Get user from temporary profile by profile id
            $profile = $this->temporary::find($pid);

            // Update temporary profile
            $profile->komentar = $komentar;
            $profile->status = $status;
            $profile->save();

            if ($status == 'active') {                
                if ($profile) $save = $this->save($profile);
                if ($save) $delete = $this->delete($pid);
            }

            // send mail
            // $mail = $this->sendMail($from, $to, $mail);

            return redirect()->route('admin.index')->with('success', 'Profil je izmenjen.');
        }
        return redirect()->route('admin.index')->with('alert', 'Nešto nije u redu, pokušajte kasnije.');
    }

    /**
     * Return the create profile form if the profile is not exits.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // /profile/create
        $title = __('Dodaj novi profil');
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
        return $request->all();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  object $data
     * @return \Illuminate\Http\Response
     */
    public function save($data)
    {
        // If not isset author id use uid for it.
        $author = ($data->author) ? $data->author : $data->uid;

        // Set profile
        $profile = $this->profile;
        $profile->uid = $data->uid;
        $profile->langcode = 'sr';
        $profile->ime = ucwords($data->ime);
        $profile->prezime = ucwords($data->prezime);
        $profile->slika = $data->slika;
        $profile->smer = $data->smer;
        $profile->nivo_studija = $data->nivo_studija;
        $profile->godina_diplomiranja = $data->godina_diplomiranja;
        $profile->naziv_firme = empty($data->naziv_firme) ? '/' : $data->naziv_firme;
        $profile->radno_mesto = empty($data->radno_mesto) ? '/' : $data->radno_mesto;
        $profile->biografija = $data->biografija;
        $profile->poruka = empty($data->poruka) ? '' : $data->poruka;
        $profile->author = $author;
        
        // Save profile
        $saved = $profile->save();

        return ($saved) ? true : false;
    }

    /**
     * Send mail
     */
    public function sendMail()
    {

    }

    /**
     * Delete profile
     */
    public function delete($pid)
    {
        // delete temporary profile where profile id = $pid
        $profile = $this->temporary::find($pid);
        $delete = $profile->delete();

        return ($delete) ? true : false;
    }

}
