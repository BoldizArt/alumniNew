<?php

namespace Alumni\Http\Controllers\Email;

use Alumni\Http\Controllers\Email\EmailController as Email;
use Illuminate\Http\Request;
use Alumni\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Alumni\Profile;
use Alumni\User;

class EmailActions extends Controller
{
    public function send(Request $request)
    {
        if (!empty($request->get('pid'))) {
            // Get data from request
            $subject = $request->get('tema');
            $message = $request->get('poruka');
            $pid = $request->get('pid');

            // Get the currently authenticated users email.
            $from = Auth::user()->email;
            $name = Auth::user()->name;

            // Get the users email address where the email will be sent.
            $profile = Profile::find($pid);
            $uid = $profile->uid;
            $user = User::find($uid);
            $to = $user->email;

            // Prepair and send mail.
            $mail = new Email();
            
            $mail->from($from);
            $mail->name($name);
            $mail->title("Alumni: Nova poruka od $from ($name)");
            $mail->subject($subject);
            $mail->to($to);
            $mail->content($message);
            // $mail->send();
        }
        return redirect()->back()->with('success', 'Vaša poruka je uspešno poslata.');
    }
}
