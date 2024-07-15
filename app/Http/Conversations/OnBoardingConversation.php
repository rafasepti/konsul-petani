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
use Illuminate\Support\Facades\Log;

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
        $this->ask('Hello! What is your firstname?', function (Answer $answer) {
            // Save result
            $this->firstname = $answer->getText();

            $this->say('Nice to meet you ' . $this->firstname);
            $this->askEmail();
        });
    }

    public function askEmail()
    {
        $this->ask('One more thing - what is your email?', function (Answer $answer) {
            // Save result
            $this->email = $answer->getText();

            $this->say('Great - that is all we need, ' . $this->firstname);
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
        // Define common words to ignore
        $commonWords = ['apa', 'penyakit', 'definisi', 'sebutkan', 'padi'];

        // Convert to lowercase and trim whitespace
        $definisi = strtolower(trim($definisi));
        Log::info("Processed input: " . $definisi);

        // Remove common words from the input
        $keywords = array_diff(explode(' ', $definisi), $commonWords);
        Log::info("Keywords after removing common words: " . implode(', ', $keywords));

        // Reconstruct the query string without common words
        $queryPhrase = implode(' ', $keywords);
        Log::info("Query phrase: " . $queryPhrase);

        // Attempt exact phrase match first
        $penyakit = Penyakit::whereRaw('LOWER(nama_penyakit) like ?', ['%' . strtolower($queryPhrase) . '%'])->first();
        Log::info("Exact match found: " . ($penyakit ? 'Yes' : 'No'));

        if ($penyakit) {
            $question = $this->type . ' ' . $penyakit->nama_penyakit;
            $response = 'Definisi ' . $penyakit->nama_penyakit . ': ' . $penyakit->definisi;
            $this->say($response);
            $this->store($response, $question, $penyakit->id_penyakit);
            return;
        }

        // If no exact match, fallback to keyword search
        foreach ($keywords as $keyword) {
            if (empty($keyword)) continue; // Skip empty keywords
            Log::info("Checking keyword: " . $keyword);
            $penyakit = Penyakit::whereRaw('LOWER(nama_penyakit) like ?', ['%' . strtolower($keyword) . '%'])->first();
            Log::info("Match found for keyword '$keyword': " . ($penyakit ? 'Yes' : 'No'));

            if ($penyakit) {
                $question = $this->type . ' ' . $penyakit->nama_penyakit;
                $response = 'Definisi ' . $penyakit->nama_penyakit . ': ' . $penyakit->definisi;
                $this->say($response);
                $this->store($response, $question, $penyakit->id_penyakit);
                return;
            }
        }

        // If no match found
        $this->say('Maaf, definisi untuk penyakit tersebut tidak ditemukan.');
    }

    public function giveSolution($solusi)
    {
        // Define common words to ignore
        $commonWords = ['apa', 'penyakit', 'solusi', 'sebutkan', 'padi'];

        // Convert to lowercase and trim whitespace
        $solusi = strtolower(trim($solusi));
        Log::info("Processed input: " . $solusi);

        // Remove common words from the input
        $keywords = array_diff(explode(' ', $solusi), $commonWords);
        Log::info("Keywords after removing common words: " . implode(', ', $keywords));

        // Reconstruct the query string without common words
        $queryPhrase = implode(' ', $keywords);
        Log::info("Query phrase: " . $queryPhrase);

        // Attempt exact phrase match first
        $penyakitSolusi = PenyakitSolusi::whereHas('penyakit', function ($q) use ($queryPhrase) {
            $q->whereRaw('LOWER(nama_penyakit) like ?', ['%' . strtolower($queryPhrase) . '%']);
        })->first();
        Log::info("Exact match found: " . ($penyakitSolusi ? 'Yes' : 'No'));

        if ($penyakitSolusi) {
            $question = $this->type . ' ' . $penyakitSolusi->penyakit->nama_penyakit;
            $response = 'Solusi untuk ' . $penyakitSolusi->penyakit->nama_penyakit . ': ' . $penyakitSolusi->solusi;
            $this->say($response);
            $this->store($response, $question, $penyakitSolusi->id_penyakit);
            return;
        }

        // If no exact match, fallback to keyword search
        foreach ($keywords as $keyword) {
            if (empty($keyword)) continue; // Skip empty keywords
            Log::info("Checking keyword: " . $keyword);
            $penyakitSolusi = PenyakitSolusi::whereHas('penyakit', function ($q) use ($keyword) {
                $q->whereRaw('LOWER(nama_penyakit) like ?', ['%' . strtolower($keyword) . '%']);
            })->first();
            Log::info("Match found for keyword '$keyword': " . ($penyakitSolusi ? 'Yes' : 'No'));

            if ($penyakitSolusi) {
                $question = $this->type . ' ' . $penyakitSolusi->penyakit->nama_penyakit;
                $response = 'Solusi untuk ' . $penyakitSolusi->penyakit->nama_penyakit . ': ' . $penyakitSolusi->solusi;
                $this->say($response);
                $this->store($response, $question, $penyakitSolusi->id_penyakit);
                return;
            }
        }

        // If no match found
        $this->say('Maaf, solusi untuk penyakit tersebut tidak ditemukan.');
    }


    public function giveGejala($gejala)
    {
        // Define common words to ignore
        $commonWords = ['apa', 'penyakit', 'gejala', 'sebutkan', 'padi'];

        // Convert to lowercase and trim whitespace
        $gejala = strtolower(trim($gejala));
        Log::info("Processed input: " . $gejala);

        // Remove common words from the input
        $keywords = array_diff(explode(' ', $gejala), $commonWords);
        Log::info("Keywords after removing common words: " . implode(', ', $keywords));

        // Reconstruct the query string without common words
        $queryPhrase = implode(' ', $keywords);
        Log::info("Query phrase: " . $queryPhrase);

        // Attempt exact phrase match first
        $penyakit = Penyakit::whereRaw('LOWER(nama_penyakit) like ?', ['%' . strtolower($queryPhrase) . '%'])->first();
        Log::info("Exact match found: " . ($penyakit ? 'Yes' : 'No'));

        if ($penyakit) {
            $question = $this->type . ' ' . $penyakit->nama_penyakit;
            $response = 'Gejala ' . $penyakit->nama_penyakit . ': ' . $penyakit->gejala;
            $this->say($response);
            $this->store($response, $question, $penyakit->id_penyakit);
            return;
        }

        // If no exact match, fallback to keyword search
        foreach ($keywords as $keyword) {
            if (empty($keyword)) continue; // Skip empty keywords
            Log::info("Checking keyword: " . $keyword);
            $penyakit = Penyakit::whereRaw('LOWER(nama_penyakit) like ?', ['%' . strtolower($keyword) . '%'])->first();
            Log::info("Match found for keyword '$keyword': " . ($penyakit ? 'Yes' : 'No'));

            if ($penyakit) {
                $question = $this->type . ' ' . $penyakit->nama_penyakit;
                $response = 'Gejala ' . $penyakit->nama_penyakit . ': ' . $penyakit->gejala ;
                $this->say($response);
                $this->store($response, $question, $penyakit->id_penyakit);
                return;
            }
        }

        // If no match found
        $this->say('Maaf, gejala untuk penyakit tersebut tidak ditemukan.');
    }

    public function store($answer, $question, $id_penyakit)
    {
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
