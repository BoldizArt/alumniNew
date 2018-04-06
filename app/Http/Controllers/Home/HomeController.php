<?php

namespace Alumni\Http\Controllers\Home;

use Illuminate\Http\Request;
use Alumni\Http\Controllers\Controller;
use Alumni\Profile;

class HomeController extends Controller
{
    public function index()
    {
        $data['description']['title'] = 'GDE RADE DIPLOMIRANI STUDENTI TEHNIČKOG FAKULTETA "MIHAJLO PUPIN" U ZRENJANINU?';
        $data['description']['text'] = 'Neki od naših diplomiranih studenata prezentovali su podatke o svojim radnim biografijama, opisali svoja iskustva sa studija i uputili poruke budućim kolegama...';

        $data['profiles'] = Profile::select('ime', 'prezime', 'smer', 'id', 'slika')
            ->inRandomOrder()
            ->limit(8)
            ->get();

        $data['statistics']['all'] = Profile::count();
        $data['statistics']['bsc'] = Profile::where('nivo_studija', 'Osnovne studije')->count();
        $data['statistics']['msc'] = Profile::where('nivo_studija', 'Master studije')->count();
        $data['statistics']['dr'] =  Profile::where('nivo_studija', 'Doktorske studije')->count();

        

        $data['messages'] = Profile::select('ime', 'prezime', 'poruka', 'id', 'slika')
            ->whereNotIn('poruka', [''])
            ->inRandomOrder()
            ->limit('6')
            ->get();
        
        return view('home')->with('data', $data);
    }
}
