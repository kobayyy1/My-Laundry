<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;

class LoginAdmin extends Component
{
    public $email, $password;

    public function login()
    {
        $this->validate([
            'email' => 'required|min:4|email|max:255',
            'password' => 'required|min:8',
        ],[
            'email.required' => 'Alamat email tidak boleh kosong!',
            'email.min' => 'Alamat email tidak dikenal!',
            'email.email' => 'Alamat email tidak dikenal!',
            'email.max' => 'Alamat email tidak dikenal!',
            'password.required' => 'Password tidak boleh kosong!',
            'password.min' => 'Password tidak boleh kurang dari 8 karakter!',
        ]);

        if (Auth::guard('admins')->attempt(['email' => $this->email, 'password' => $this->password])) {
            return redirect()->intended()->route('admin.dashboard');
        } else {
            $this->dispatch('errorLogin');
        }
    }

    public function render()
    {
        return view('livewire.auth.login-admin');
    }
}
