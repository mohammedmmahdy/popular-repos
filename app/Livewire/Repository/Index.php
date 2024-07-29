<?php

namespace App\Livewire\Repository;

use Livewire\Component;
use App\Mail\SendExcelMail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class Index extends Component
{
    public $per_page = 10;
    public $language;
    public $created_at   = '2019-01-10';
    public $repositories = [];




    public function sendMail()
    {
        Mail::to('test@test.com')->send(new SendExcelMail(collect($this->repositories)));
        session()->flash('success', 'Mail has been sent.');
    }
    public function render()
    {
        $response = Http::get('https://api.github.com/search/repositories', [
            'q'        => 'language:' . $this->language . ' created:>' . $this->created_at,
            'sort'     => 'stars',
            'order'    => 'desc',
            'per_page' => $this->per_page,
        ]);

        $this->repositories = $response->json()['items'] ?? [];
        return view('livewire.repository.index', [
            'repositories' => $this->repositories
        ]);
    }
}
