<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
	public function index(){
		
		$uid = Auth::user()->id;
		$name = Auth::user()->name;		
		$email = Auth::user()->email;


    	return view('user')->with(['uid' => $uid, 'name' => $name, 'email' => $email]);
	}
}
