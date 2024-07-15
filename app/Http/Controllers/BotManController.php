<?php

namespace App\Http\Controllers;

use App\Http\Conversations\OnBoardingConversation;
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
            $this->handleMessage($botman, $message);
        });

        $botman->listen();
    }

    public function handleMessage($botman, $message)
    {
        $lowercaseMessage = strtolower($message);
        if (stripos($lowercaseMessage, 'solusi') !== false) {
            $solusi = str_replace('solusi', '', $message);
            $botman->startConversation(new \App\Http\Conversations\OnBoardingConversation('solusi', trim($solusi)));
        } elseif (stripos($lowercaseMessage, 'definisi') !== false) {
            $definisi = str_replace('definisi', '', $message);
            $botman->startConversation(new \App\Http\Conversations\OnBoardingConversation('definisi', trim($definisi)));
        } elseif (stripos($lowercaseMessage, 'gejala') !== false) {
            $gejala = str_replace('gejala', '', $message);
            $botman->startConversation(new \App\Http\Conversations\OnBoardingConversation('gejala', trim($gejala)));
        } elseif (stripos($lowercaseMessage, 'pakar') !== false) {
            $botman->startConversation(new \App\Http\Conversations\OnBoardingConversation('pakar'));
        } else {
            $botman->reply('Maaf, data tidak ditemukan. Silakan tanya yang lain.');
        }
    }
}
