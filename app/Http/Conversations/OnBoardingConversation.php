<?php

namespace App\Http\Conversations;

use App\Models\Penyakit;
use App\Models\PenyakitSolusi;
use App\Models\Pertanyaan;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OnBoardingConversation extends Conversation
{
    protected $firstname;

    protected $email;

    protected $type;
    protected $query;

    public function __construct($type = null, $query = null)
    {
        $this->type = $type;
        $this->query = $query;
    }

    public function run()
    {
        if ($this->type === 'definisi') {
            $this->giveDefinition($this->query);
        } elseif ($this->type === 'solusi') {
            $this->giveSolution($this->query);
        } elseif ($this->type === 'gejala') {
            $this->giveGejala($this->query);
        } elseif ($this->type === 'pakar') {
            $this->sendLinkButton();
        } else {
            $this->say('Maaf, data tidak ditemukan silakan tanya yang lain.');
        }
    }

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

    public function sendLinkButton()
    {
        $this->say('Link whatsapp: <a href="https://wa.link/0wrvo0" target="_blank">https://wa.link/0wrvo0</a>');
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
                $question = $this->type.' '. $penyakit->nama_penyakit;
                $response = 'Definisi ' . $penyakit->nama_penyakit . ': ' . $penyakit->definisi;
                $this->say($response);
                $this->store($response, $question, $penyakit->id_penyakit);
                return;
            }
        }
    
        // Jika tidak ditemukan
        $this->say('Maaf, definisi untuk penyakit tersebut tidak ditemukan.');
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
                $question = $this->type.' '. $penyakitSolusi->penyakit->nama_penyakit;
                $response = 'Solusi untuk ' . $penyakitSolusi->penyakit->nama_penyakit . ': ' . $penyakitSolusi->solusi;
                $this->say($response);
                $this->store($response, $question, $penyakitSolusi->id_penyakit);
                return; // Keluar setelah menemukan definisi
            }
        }

        // Jika tidak ditemukan
        $this->say('Maaf, solusi untuk penyakit tersebut tidak ditemukan.');
    }

    public function giveGejala($gejala)
    {
        // Pisahkan input menjadi kata-kata terpisah
        $keywords = explode(' ', $gejala);
    
        // Cari setiap kata dalam database
        foreach ($keywords as $keyword) {
            $penyakit = Penyakit::where('nama_penyakit', 'like', '%' . $keyword . '%')->first();
            if ($penyakit) {
                $question = $this->type.' '. $penyakit->nama_penyakit;
                $response = 'Gejala ' . $penyakit->nama_penyakit . ': ' . $penyakit->gejala;
                $this->say($response);
                $this->store($response, $question, $penyakit->id_penyakit);
                return;
            }
        }
    
        // Jika tidak ditemukan
        $this->say('Maaf, gejala untuk penyakit tersebut tidak ditemukan.');
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
}
