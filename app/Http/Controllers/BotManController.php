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

    // public function askQuestion($botman)
    // {
    //     $botman->ask('Apakah Anda ingin mencari definisi atau solusi? Ketik "definisi" atau "solusi"', function (Answer $answer, $conversation) {
    //         $choice = strtolower($answer->getText());

    //         if ($choice == 'definisi') {
    //             $this->askForDefinition();
    //         } elseif ($choice == 'solusi') {
    //             $this->askForSolution();
    //         } else {
    //             $this->say('Pilihan tidak valid. Silakan ketik "definisi" atau "solusi".');
    //         }
    //     });
    // }

    // public function askForDefinition()
    // {
    //     $this->ask('Definisi apa yang Anda cari?', function (Answer $answer) {
    //         $definisi = $answer->getText();
    //         $this->giveDefinition($definisi);
    //     });
    // }

    // public function askForSolution()
    // {
    //     $this->ask('Solusi untuk penyakit apa yang Anda cari?', function (Answer $answer) {
    //         $solusi = $answer->getText();
    //         $this->giveSolution($solusi);
    //     });
    // }

    // public function giveDefinition($definisi)
    // {
    //     $penyakit = Penyakit::where('nama_penyakit', 'like', '%' . $definisi . '%')->first();

    //     if ($penyakit) {
    //         $this->say('Definisi ' . $penyakit->nama_penyakit . ': ' . $penyakit->definisi);
    //     } else {
    //         $this->say('Maaf, definisi untuk penyakit tersebut tidak ditemukan.');
    //     }
    // }

    // public function giveSolution($solusi)
    // {
    //     $penyakitSolusi = PenyakitSolusi::whereHas('penyakit', function ($query) use ($solusi) {
    //         $query->where('nama_penyakit', 'like', '%' . $solusi . '%');
    //     })->first();

    //     if ($penyakitSolusi) {
    //         $this->say('Solusi untuk ' . $penyakitSolusi->penyakit->nama_penyakit . ': ' . $penyakitSolusi->solusi);
    //     } else {
    //         $this->say('Maaf, solusi untuk penyakit tersebut tidak ditemukan.');
    //     }
    // }
}
