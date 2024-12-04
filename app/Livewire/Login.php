<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

class Login extends Component
{

    public bool $check = false;

    public $email = '';
    
    public $password = '';

    #[Title('Login')]
    public function render()
    {
        return view('livewire.login');
    }

  
    public function HandleLogin() {
        
        $cred = $this->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required'
        ]);

        if (Auth::attempt($cred, $this->check)) {

            session(null)->regenerate();
            return $this->redirect(route('in'), navigate: true);
        }

        $this->addError('email', 'Password Not Match');

    }
    
    public function boot(){
        if (auth()->user()) {
            $this->redirect(route('in'), navigate: true);
        }
    }
}