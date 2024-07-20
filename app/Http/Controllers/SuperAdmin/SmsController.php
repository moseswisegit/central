<?php

namespace App\Http\Controllers\superAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Twilio\Exceptions\RestException;

class SmsController extends Controller
{
    public function send() {
        // Find your Account SID and Auth Token at twilio.com/console
        // and set the environment variables. See http://twil.io/secure
        $sid = getenv("TWILIO_SID");
        $token = getenv("TWILIO_TOKEN");
        $senderNumber = getenv("TWILIO_PHONE_NUMBER");

        if (!$sid || !$token || !$senderNumber) {
            dd("Twilio credentials are not set properly.");
        }

        $twilio = new Client($sid, $token);

        try {
            $message = $twilio->messages
                              ->create("+2250556117423", // to
                                       [
                                           "body" => "This is the ship that made the Kessel Run in fourteen parsecs?",
                                           "from" => $senderNumber
                                       ]
                              );

            dd("succès");

        } catch (RestException $e) {
            dd("Twilio error: " . $e->getMessage());
        } catch (\Exception $e) {
            dd("General error: " . $e->getMessage());
        }
    }
}
