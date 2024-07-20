<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Twilio\Rest\Client;
use Twilio\Http\CurlClient;
use Twilio\Http\Response;
use Twilio\Exceptions\HttpException;

// Custom CurlClient to set the CA certificate
class CustomCurlClient extends CurlClient
{
    protected $caCertPath;

    public function __construct($caCertPath)
    {
        parent::__construct();
        $this->caCertPath = $caCertPath;
    }

    public function request(string $method, string $url, array $params = [], array $data = [], array $headers = [], ?string $user = null, ?string $password = null, ?int $timeout = null): Response
    {
        $options = $this->options($method, $url, $params, $data, $headers, $user, $password, $timeout);
        $options[CURLOPT_CAINFO] = $this->caCertPath; // Path to cacert.pem

        $curl = curl_init();
        curl_setopt_array($curl, $options);
        $result = curl_exec($curl);
        $error = curl_error($curl);
        $info = curl_getinfo($curl);

        if ($result === false) {
            throw new HttpException($error);
        }

        curl_close($curl);

        return new Response($info['http_code'], $result);
    }
}

class WhatsAppController extends Controller
{
    public function send()
    {
        $twilioSid = env('TWILIO_SID');
        $twilioToken = env('TWILIO_AUTH_TOKEN');
        $twilioWhatsAppNumber = env('TWILIO_WHATSAPP_NUMBER');
        $recipientNumber = 'whatsapp:+2250556117423';
        $message = "Hello from Programming Experience";

        // Path to cacert.pem
        $caCertPath = base_path('cacert.pem');

        // Initialize the custom CurlClient
        $httpClient = new CustomCurlClient($caCertPath);

        // Initialize the Twilio client
        $twilio = new Client($twilioSid, $twilioToken);
        $twilio->setHttpClient($httpClient);

        try {
            $twilio->messages->create(
                $recipientNumber,
                [
                    "from" => 'whatsapp:' . $twilioWhatsAppNumber,
                    "body" => $message,
                ]
            );

            return response()->json(['message' => 'WhatsApp message sent successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
