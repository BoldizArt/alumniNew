<?php

namespace Alumni\Http\Controllers\Email;

use Illuminate\Http\Request;
use Alumni\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    // Variables
    protected $sendMail;
    protected $from = 'default@mail.alumni';
    protected $name = 'Alumni Team';
    protected $title = 'Nova poruka od Alumni zajednice';
    protected $subject;
    protected $to;
    protected $content;
    protected $attach;

    public function __construct()
    {
        $this->sendMail = new Mail();
    }

    /**
     * Send message using obtained parameters.
     * @param array $msgs
     * 
     * @return response
     */
    public function send()
    {
        // Check if empty any of required variable.
        if (!empty($this->to) && !empty($this->content)) { 
            // Send email.
            $this->sendMail->send('email.send', ['title' => $this->title, 'content' => $this->content], function ($message) use ($attach)
            {
                $message->from($this->from, $this->name);
                $message->to($this->to);
                if ($this->subject) $message->subject($this->subject);
                if ($this->attach) $message->attach($this->attach);
            });

            // Return success msessage.
            $msg = 'Poruka je poslata.';
            return response()->with('success', $msg);

        }

        // Return success or error msessage.
        $msg = 'Poruka nije poslata.';
        return response()->with('error', $msg);
    }

    /**
     * Set $from (sender email address) variable.
     * @param email $from
     */
    public function from($from)
    {
        $this->from = $from;
    }

    /**
     * Set $name (name of message sender) variable.
     * @param string $name
     */
    public function name($name)
    {
        $this->name = $name;
    }

    /**
     * Set $to (getter email address) variable.
     * @param email $to
     */
    public function to($to)
    {
        $this->to = $to;
    }

    /**
     * Set $title variable.
     * @param string $title
     */
    public function title($title)
    {
        $this->title = $title;
    }

    /**
     * Set $subject variable.
     * @param string $subject
     */
    public function subject($subject)
    {
        $this->subject = $subject;
    }
    
    /**
     * Set $content variable.
     * @param string $content
     */
    public function content($content)
    {
        $this->content = $content;
    }    
    
    /**
     * Set $attach variable.
     * @param file $attach
     */
    public function attach($attach)
    {
        $this->attach = $attach;
    }

}
