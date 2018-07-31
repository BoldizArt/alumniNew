<?php

namespace Alumni\Http\Controllers\Actions;

use Alumni\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;

// Mine controllers
use Alumni\Profile;
use Alumni\TemporaryProfile;

class ActionsController extends Controller
{
    /**
     * Check if created frofile for this user
     *
     * @param  int $uid
     * @return boolean
     */
    public function exists($uid)
    {
        $tProfile = $this->isTemporaryProfileExists($uid);
        $profile = $this->isProfileExists($uid);

        return ($profile || $tProfile) ? true : false;
    }

    /**
     * Check if created frofile for this user
     *
     * @param  int $uid
     * @return boolean
     */
    public function get($uid)
    {
        $profile = false;
        if($this->isTemporaryProfileExists($uid)) {
            $profile = $this->getTemporaryProfile($uid);
        } elseif ($this->isProfileExists($uid)) {
            $profile = $this->getProfile($uid);
        }

        return $profile;
    }

    /**
     * Delete all type of profile for $uid.
     *
     * @param  int $uid
     * @return boolean
     */
    public function delete($uid)
    {
        $deleted = 0;
        while ($profile = $this->getTemporaryProfile($uid)) {
            $profile->delete();
            $deleted++;
        }
        while ($profile = $this->getProfile($uid)) {
            $profile->delete();
            $deleted++;
        }

        return $deleted;
    }

    /**
     * Check if created frofile for this user
     *
     * @param  int $uid
     * @return boolean
     */
    public function isProfileExists($uid)
    {
        $profile = Profile::where('uid', $uid)->count();
        return ($profile > 0) ? true : false;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  int $uid
     * @return boolean
     */
    public function isTemporaryProfileExists($uid)
    {
        $profile = TemporaryProfile::where('uid', $uid)->count();
        return ($profile > 0) ? true : false;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  int $uid
     * @return object profile
     */
    public function getProfile($uid)
    {
        $profile = ($this->isProfileExists($uid)) ?
            Profile::where('uid', $uid)
                ->first() : false;
        
        return $profile;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  int $uid
     * @return object profile
     */
    public function getTemporaryProfile($uid)
    {
        $profile = ($this->isTemporaryProfileExists($uid)) ?
            TemporaryProfile::where('uid', $uid)
                ->first() : FALSE;
        
        return $profile;
    }

    /**
     * Save image from request and return its name
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveImage(Request $request)
    {
        // Set variables
        $input = $request->all();
        $rules =
        [
            'slika' => 'mimes:jpeg,jpg,png|max:1999'
        ];

        $messages =
        [
            'mimes' => 'Dozvoljeni formati fajla su jpeg, jpg i png.'
        ];
        
        // Validate input
        $validator = Validator::make($input, $rules, $messages);

        // If validateor fall, return an error message
        if ($validator->fails())
        {
            return response()->json([ 
                'error' => $validator
            ]);
        }

        // Upload image
        $imageName = '';
        $name = substr(md5(rand(5,10)),3,6);
        if($request->hasFile('slika'))
        {
            $image = $request->file('slika');
            $imageName = $name.'_'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $imageName);

            // Crop image to has 1:1 resolution.
            $this->cropImage($destinationPath, $imageName);
        }

        return response()->json([ 'url' => $imageName ]);
    }

    /**
     * Crop image to have resolution 1:1.
     * @param string $path
     * @param string $name
     */
    public function cropImage($path, $name)
    {
        // the image to crop
        $image = $path.'/'.$name;
        
        // make sure the directory is writeable
        $dest_image = $path.'/'.$name; 

        // Get image size;
        $ims = getimagesize($image);
        $w = $ims[0];
        $h = $ims[1];

        // Set max value.
        $max = ($w - $h > 0) ? $h : $w;

        // imagecreatetruecolor
        $img = imagecreatetruecolor($max, $max);

        // Check extension
        if ($ims['mime'] == 'image/jpg' || $ims['mime'] == 'image/jpeg') {
            $org_img = imagecreatefromjpeg($image);
        } else {
            $org_img = imagecreatefrompng($image);
        }

        // Crop image
        $a = ($w - $h > 0) ? (($w - $h) / 2) : 0;
        $b = ($h - $w > 0) ? (($h - $w) / 2) : 0;
        imagecopy($img, $org_img, 0, 0, $a, $b, $max, $max);

        imagejpeg($img, $dest_image, 90);

        // imagedestroy($img);
    }


    /**
     * Validate input data
     */
    public function validateUser($input)
    {
        $rules =
        [
            'ime' => 'required|regex:/^[\p{Latin}[A-Za-z ]+$/u|string|min:3',
            'prezime' => 'required|regex:/^[\p{Latin}[A-Za-z ]+$/u|string|min:3',
            'smer' => 'required',
            'nivo_studija' => 'required',
            'godina_diplomiranja' => 'required|date_format:Y|max:'.date('Y'),
            'biografija' => 'required',
        ];

        $messages =
        [
            'required' => 'Polje :attribute je obavezno!',
            'date_format' => 'Upišite samo godinu diplomiranja.',
            'regex' => 'Polje :attribute ne sme da sadrži specijalne karaktere.',
            'min' => 'Minimalna dužina karaktera za polje :attribute je tri slova.'
        ];

        // Validate the request
        $validator = Validator::make($input, $rules, $messages);

        return $validator;
    }

    /**
     * Resize image 1:1 ratio.
     * 
     * @param string
     * @return boolean
     */
    public function resize($image)
    {
       
    }

}
