<?php

namespace Alumni\Http\Controllers\Home;

use Illuminate\Http\Request;
use Alumni\Http\Controllers\Controller;
use Alumni\Profile;

class HomeController extends Controller
{
    public function index(Profile $profile)
    {
        $data['description']['title'] = 'GDE RADE DIPLOMIRANI STUDENTI TEHNIČKOG FAKULTETA "MIHAJLO PUPIN" U ZRENJANINU?';
        $data['description']['text'] = 'Neki od naših diplomiranih studenata prezentovali su podatke o svojim radnim biografijama, opisali svoja iskustva sa studija i uputili poruke budućim kolegama...';

        $data['profiles'] = $profile::select('ime', 'prezime', 'smer', 'id', 'slika')
            ->where('profile_type', 'student')
            ->inRandomOrder()
            ->limit(8)
            ->get();

        $data['statistics']['all'] = $profile::where('profile_type', 'student')->count();
        $data['statistics']['bsc'] = $profile::where([
            ['nivo_studija', 'Osnovne studije'], 
            ['profile_type', 'student']
        ])->count();
        $data['statistics']['msc'] = $profile::where([
            ['nivo_studija', 'Master studije'], 
            ['profile_type', 'student']
        ])->count();
        $data['statistics']['dr'] =  $profile::where([
            ['nivo_studija', 'Doktorske studije'], 
            ['profile_type', 'student']
        ])->count();

        

        $data['messages'] = $profile::select('ime', 'prezime', 'poruka', 'id', 'slika')
            ->whereNotIn('poruka', [''])
            ->where('profile_type', 'student')
            ->inRandomOrder()
            ->limit('6')
            ->get();
        
        return view('home')->with('data', $data);
    }
}
