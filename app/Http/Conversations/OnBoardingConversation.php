<?php

namespace App\Http\Conversations;

use App\Models\Penyakit;
use App\Models\PenyakitSolusi;
use App\Models\Pertanyaan;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OnBoardingConversation extends Conversation
{
    protected $firstname;

    protected $email;

    public function askFirstname()
    {
        $this->ask('Hello! What is your firstname?', function(Answer $answer) {
            // Save result
            $this->firstname = $answer->getText();

            $this->say('Nice to meet you '.$this->firstname);
            $this->askEmail();
        });
    }

    public function askEmail()
    {
        $this->ask('One more thing - what is your email?', function(Answer $answer) {
            // Save result
            $this->email = $answer->getText();

            $this->say('Great - that is all we need, '.$this->firstname);
            $this->askFirstname();
        });
    }
    public function run()
    {
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
        // Pisahkan input menjadi kata-kata terpisah
        $keywords = explode(' ', $definisi);
    
        // Cari setiap kata dalam database
        foreach ($keywords as $keyword) {
            $penyakit = Penyakit::where('nama_penyakit', 'like', '%' . $keyword . '%')->first();
            if ($penyakit) {
                $response = 'Definisi ' . $penyakit->nama_penyakit . ': ' . $penyakit->definisi;
                $this->say($response);
                $this->store($response, $definisi, $penyakit->id_penyakit);
                return;
            }
        }
    
        // Jika tidak ditemukan
        $this->say('Maaf, definisi untuk penyakit tersebut tidak ditemukan.');
    }

    public function store($answer, $question, $id_penyakit){
        DB::table('pertanyaan')->insert([
            'pertanyaan' => $question,
            'jawaban' => $answer,
            'id_penyakit' => $id_penyakit,
            'id_petani' => Auth::id(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        //$this->say('data berhasil dimasukan ke db '. $answer.' ' .$question. ' '.$id_penyakit. ' '. Auth::id());
    }

    public function giveSolution($solusi)
    {
        $keywords = explode(' ', $solusi);

        // Cari setiap kata dalam database
        foreach ($keywords as $keyword) {
            $penyakitSolusi = PenyakitSolusi::whereHas('penyakit', function ($query) use ($keyword, $solusi) {
                $query->where('nama_penyakit', 'like', '%' . $keyword . '%');
            })->first();
            if ($penyakitSolusi) {
                $response = 'Solusi untuk ' . $penyakitSolusi->penyakit->nama_penyakit . ': ' . $penyakitSolusi->solusi;
                $this->say($response);
                $this->store($response, $solusi, $penyakitSolusi->id_penyakit);
                return; // Keluar setelah menemukan definisi
            }
        }

        // Jika tidak ditemukan
        $this->say('Maaf, solusi untuk penyakit tersebut tidak ditemukan.');
    }
}
