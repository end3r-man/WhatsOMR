<?php

namespace App\Livewire\Index;

use chillerlan\QRCode\QRCode;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Whats extends Component
{
    public $data;

    public $result;

    public $luser;

    #[Rule('required')]
    public $number = '';

    #[Rule('required')]
    public $msg = '';

    public function render()
    {
        return view('livewire.index.whats');
    }

    public function mount()
    {
        try {
            $client = Http::timeout(10)->get('http://localhost:3000/qr');
            $this->luser = 1;
        } catch (\Throwable $th) {
            $this->luser = 3;
        }

        if ($this->luser != 3) {
            if ($client['status'] == false) {
                if (! is_null($client)) {
                    $this->data = $client['qrs'];
                    $this->result = (new QRCode)->render($this->data);
                }
                $this->luser = 1;
            } elseif ($client['status'] == true) {
                $this->luser = 2;
            }
        }

    }

    public function genrc()
    {
        $this->mount();
    }

    public function msgs()
    {
        $urlm = 'http://localhost:3000/msg';

        $sendc = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post($urlm, [
            'number' => 9080962674,
            'name' => 'test',
            'data' => now()->format('d-m-Y'),
            'time' => now()->format('h:i'),
            'email' => 'opt',
            'gender' => 'male',
        ]);

        dd($sendc->body());

        $this->reset();
    }

    public function lgout()
    {
        $lgout = Http::get('http://localhost:3000/logout');

        if ($lgout['status'] == false) {
            $this->redirect('/in');
        }

    }
}
