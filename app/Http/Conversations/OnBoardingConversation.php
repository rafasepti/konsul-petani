<?php

namespace App\Http\Conversations;

use App\Models\Penyakit;
use App\Models\PenyakitSolusi;
use BotMan\BotMan\Messages\Conversations\Conversation;

class OnBoardingConversation extends Conversation {
    public function run(){
            $this->ask('Apakah Anda ingin mencari definisi atau solusi? Ketik "definisi" atau "solusi"', function ($answer) {
            $choice = strtolower($answer->getText());

            if ($choice == 'definisi') {
                $this->askForDefinition();
            } elseif ($choice == 'solusi') {
                $this->askForSolution();
            } else {
                $this->say('Pilihan tidak valid. Silakan ketik "definisi" atau "solusi".');
            }
        });
    }
    
    public function askForDefinition()
    {
        $this->ask('Definisi apa yang Anda cari?', function ($answer) {
            $definisi = $answer->getText();
            $this->giveDefinition($definisi);
        });
    }

    public function askForSolution()
    {
        $this->ask('Solusi untuk penyakit apa yang Anda cari?', function ($answer) {
            $solusi = $answer->getText();
            $this->giveSolution($solusi);
        });
    }

    public function giveDefinition($definisi)
    {
        $penyakit = Penyakit::where('nama_penyakit', 'like', '%' . $definisi . '%')->first();

        if ($penyakit) {
            $this->say('Definisi ' . $penyakit->nama_penyakit . ': ' . $penyakit->definisi);
        } else {
            $this->say('Maaf, definisi untuk penyakit tersebut tidak ditemukan.');
        }
    }

    public function giveSolution($solusi)
    {
        $penyakitSolusi = PenyakitSolusi::whereHas('penyakit', function ($query) use ($solusi) {
            $query->where('nama_penyakit', 'like', '%' . $solusi . '%');
        })->first();

        if ($penyakitSolusi) {
            $this->say('Solusi untuk ' . $penyakitSolusi->penyakit->nama_penyakit . ': ' . $penyakitSolusi->solusi);
        } else {
            $this->say('Maaf, solusi untuk penyakit tersebut tidak ditemukan.');
        }
    }
}