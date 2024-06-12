<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use Illuminate\Http\Request;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\Drivers\Web\WebDriver;
use Illuminate\Support\Facades\Log;

class BotManController extends Controller
{
    /**
     * Place your BotMan logic here.
     */
    public function index()
    {
        return view('konsultasi.botman');
    }

    public function handle()
    {
        $botman = app('botman');

        $botman->hears('{message}', function ($botman, $message) {

            if ($message == 'hi') {
                $this->askName($botman);
            } else {
                $botman->reply("Start a conversation by saying hi.");
            }
        });

        $botman->listen();
    }

    /**
     * Place your BotMan logic here.
     */
    public function askName($botman)
    {
        $botman->ask('Hello! What is your Name?', function (Answer $answer) {

            $name = $answer->getText();

            $this->say('Nice to meet you ' . $name);
        });
    }

    public function handleChatifyMessage(Request $request)
    {
        // Extract message and sender_id from the request
        $messageText = $request->input('message');
        $senderId = $request->input('sender_id');

        // Log the received message
        Log::info('Received message from chatify:', ['message' => $messageText, 'sender_id' => $senderId]);

        // BotMan configuration (empty for now)
        $config = [];

        // Load the WebDriver
        DriverManager::loadDriver(WebDriver::class);

        // Create an instance of BotMan
        $botman = BotManFactory::create($config);

        // Log BotMan initialization
        Log::info('BotMan initialized');

        // Define a variable to capture the bot's response
        $botResponse = null;

        // Log the exact message received by BotMan
        Log::info('Message received by BotMan:', ['message' => $messageText]);

        // Specific handler for 'ping' message
        $botman->hears('^ping$', function (BotMan $bot) use (&$botResponse) {
            $botResponse = 'pong';
            Log::info('Matched "ping" handler');
            $bot->reply($botResponse);
        });

        // Generic handler for all other messages
        $botman->hears('(.+)', function (BotMan $bot, $message) use ($senderId, &$botResponse) {
            // Log the message being processed
            Log::info('Processing message:', ['user' => $senderId, 'message' => $message]);

            // Reply with the message received
            $botResponse = "You said: " . $message;
            Log::info('Bot response set to:', ['response' => $botResponse]);
            $bot->reply($botResponse);
        });

        // Start listening for incoming messages
        $botman->listen();

        // Ensure a default response in case no handler matched
        if ($botResponse === null) {
            $botResponse = "I'm not sure how to respond to that.";
            Log::info('No matching handler found, default response set');
        }

        // Return a JSON response with the bot's response
        return response()->json(['status' => 'success', 'bot_response' => $botResponse]);
    }
}
