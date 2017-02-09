<?php

/**
 * TextController.php: 2 lines to send a text using Twilio (for Laravel and Lumen).
 *
 * By Shahzeb Khan (www.shahzeb.co or @notshahzeb on twitter)
 */

namespace App\Http\Controllers;
use Services_Twilio;
use Log;

class TextController extends Controller
{
	protected $number, $message;

	/**
	 * Create a new TextController instance
	 * @param phone-number $num Phone number for the person being texted
	 */
    public function __construct($num)
    {
    	$this->number = $num;
    }

    /**
     * Send a text message to a given number.
     * @param  text $msg Body for the text message
     * @return bool      true = text sent, false = error
     */
    public function sendText($msg){
	    // Prepare Twilio with our info in the .env file
	    $AccountSid = env('TWILIO_SID');
	    $AuthToken = env('TWILIO_AUTH_TOKEN');
	    $client = new Services_Twilio($AccountSid, $AuthToken);
	    $this->message = $msg;
	    
	    try {
		// Attempt to send our text:
	        $message = $client->account->messages->create(array(
	            "From" => "+".env('TWILIO_NUMBER'),
	            "To" => $this->number,
	            "Body" => $this->message,
	        ));
	    } catch (\Services_Twilio_RestException $e) {
		 // Something went wrong, so log the error:
	         Log::error("Twilio error while texting ".$this->number.": ".$e->getMessage());
	         return false;
	    }
	    // Everything was fine, and text was sent:
	    Log::info("Sent text to ".$this->number);
	    return true;
	 } 
}
