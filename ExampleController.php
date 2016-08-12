<?php

/**
 * An example controller for PHP's Lumen framework.
 *
 * Follow the same setup for Laravel.
 */

namespace App\Http\Controllers;
use App\Http\Controllers\TextController;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function text(){

    	// Where the magic happens:
    	$text = new TextController('1231231234');
        $text->sendText("You should get this text message! :)");

    }

}
