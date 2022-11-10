<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SentMessageController extends Controller
{
    public function sentMessage(Request $request)
    {
        // return $request->all();
        $basic  = new \Vonage\Client\Credentials\Basic("API key", "API Secret");
        $client = new \Vonage\Client($basic);

        $response = $client->sms()->send(
            new \Vonage\SMS\Message\SMS($request->mobile_number, 'CoderKhayrul', $request->message)
        );

        $message = $response->current();

        if ($message->getStatus() == 0) {
            return redirect()->back()->with('success', "The message was sent successfully\n");
        } else {
            return redirect()->back()->with('errro', "The message failed with status: " . $message->getStatus() . "\n");
        }
    }
}
