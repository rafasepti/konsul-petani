<?php

namespace App\Http\Controllers;

use App\Http\Conversations\OnBoardingConversation;
use App\Models\Penyakit;
use App\Models\PenyakitSolusi;
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

            if ($message == 'hi' || $message == 'Hi') {
                $this->askName($botman);
            } else {
                $botman->startConversation(new \App\Http\Conversations\OnBoardingConversation);
            }
        });

        $botman->listen();
    }

    /**
     * Place your BotMan logic here.
     */
    public function askName($botman)
    {
        $botman->ask('Hello! Siapa Nama anda?', function (Answer $answer) {

            $name = $answer->getText();

            $this->say('Salam Kenal ' . $name);
        });
    }
}
