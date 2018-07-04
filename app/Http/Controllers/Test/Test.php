<?php

namespace Alumni\Http\Controllers\Test;

use Illuminate\Http\Request;
use Alumni\Http\Controllers\Controller;

class Test extends Controller
{
    public function test()
    {
        // convert image.jpg -crop 713x470+5+3 output.jpg

        $command = 'cd images/; ls -l;';
        exec($command, $output, $error);
        $test = $output;

        print '<pre>';
        print_r($test);
    }
}
