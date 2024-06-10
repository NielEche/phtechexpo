<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;

class WhatsAppController extends Controller
{
    public function sendMessages()
    {
        // Initialize Twilio client
        $sid = env('TWILIO_ACCOUNT_SID');
        $token = env('TWILIO_AUTH_TOKEN');
        $twilio = new Client($sid, $token);
    
        // Read numbers from CSV file
        $numbers = file('numbers.csv', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    
        // Iterate over each number and send message
        foreach ($numbers as $receiver_number) {
            // Trim whitespace and validate the number
            $receiver_number = trim($receiver_number);
            if (preg_match('/^\+[1-9]\d{1,14}$/', $receiver_number)) {
                // Format number in E.164 format
                $toNumber = 'whatsapp:' . $receiver_number;
    
                // Send message
                $message = $twilio->messages->create($toNumber, [
                    "from" => "whatsapp:" . env('TWILIO_WHATSAPP_NUMBER'),
                    "body" => "📢 Attention Volunteers for Port Harcourt Tech Expo Event!

                    🗓️ Date: April 18th and 19th, 2024
                    🕚 Time: 11:00 AM
                    📍 Venue: Horlikins Event Centre, Eastern Bypass, PH
                    
                    Dear Volunteers,
                    
                    We're excited to announce our volunteer workshop meetup for the Port Harcourt Tech Expo event! Please mark your calendars for April 18th and 19th, and be sure to arrive promptly at 11:00 AM at Horlikins Event Centre on Eastern Bypass.
                    
                    Important Note:
                    Punctuality is crucial. Arriving after 11:00 AM will result in automatic disqualification. Absenteeism without prior notice will also be treated similarly.
                    
                    Attendance Window:
                    We expect to see you between 10:00 AM to 10:59 AM. Please ensure you arrive within this timeframe.
                    
                    Let's make the most out of this workshop and ensure our event's success!"
                ]);
    
                // Check if message was successfully sent
                if ($message->sid) {
                    echo "Message sent successfully to $receiver_number" . PHP_EOL;
                } else {
                    echo "Failed to send message to $receiver_number" . PHP_EOL;
                }
            } else {
                echo "Invalid phone number format: $receiver_number" . PHP_EOL;
            }
        }
    
        return "Messages sent successfully!";
    }
    
}
