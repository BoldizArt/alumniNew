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

        return view('public.index')->with(['data' => $data, 'title' => $title]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function created()
    {
        // /profile
        $title = __('Profili koje ste vi kreirali');
        $data = $this->profile::where('autor', $this->user->id)
            ->orderBy('ime', 'asc')
            ->paginate(10);

        return view('public.index')->with(['data' => $data, 'title' => $title]);
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
                if ($profile) $save = $this->save($profile, $this->profile);
                if ($save) $delete = $this->deleteTemporary($pid);
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
        $all = $request->all();
        
        $msg = __('Kreirali ste profil.');
        // Create an object from the array.
        $data = json_decode(json_encode($all), FALSE);
        
        // Get profile or create new profile.
        $profile = $this->profile;
        if (isset($data->id)) {
            $msg = __('Ažurirali ste profil.');
            $profile = $this->profile->find($data->id);
        }

        // Define uid if not isset.
        if (!isset($data->uid)) $data->uid = 0;

        // Save this resource
        $save = $this->save($data, $profile);
        if ($save) {
            return redirect()->route('admin.created')->with('success', $msg);
        }

        $msg = 'Došlo je do greške, pokušajte kasnije.';
        return redirect()->back()->with('alert', $msg);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  object $data
     * @return \Illuminate\Http\Response
     */
    public function save($data, $profile)
    {
        // If not isset author id use uid for it.
        $autor = ($data->autor) ? $data->autor : $data->uid;
        $saved = false;
        $tipProfila = ($data->tip_profila) ? $data->tip_profila : 'student';

        // Set profile
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
        $profile->autor = $autor;
        $profile->tip_profila = $tipProfila;
        
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
    public function deleteTemporary($pid)
    {
        // delete temporary profile where profile id = $pid
        $delete = false;
        if ($profile = $this->temporary::find($pid)) {
            $delete = $profile->delete();
        }

        return ($delete) ? true : false;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($pid)
    {
        // delete profile where profile id = $pid
        $delete = false;
        if ($profile = $this->profile::find($pid)) {
            $delete = $profile->delete();
        }

        return ($delete) ? true : false;
    }

    public function teamEdit($id)
    {
        // If isset the profile, return view
        if($profile = $this->profile::find($id))
        {
            $title = __('Izmeni profil');
            return view('user.edit')->with(['profile' => $profile, 'title' => $title]);
        }

        return redirect()->back()->with('alert', __('Došlo je do greške, pokušajte kasnije'));
    }

    public function teamDestroy(Request $request)
    {
        $id = (int)$request->post('id');

        $delete = false;
        if ($profile = $this->profile::find($id)) {
            $delete = $profile->delete();
        }

        if ($delete) return redirect()->route('admin.created')->with('success', __('Uspešno ste obrisali profil.'));

        return redirect()->back()->with('alert', __('Došlo je do greške, pokušajte kasnije'));        
    }



}
