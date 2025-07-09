<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class LoginUser extends Component
{
    public $email, $password;

    public function login()
    {
        $this->validate([
            'email' => 'required|min:4|email|max:255|email',
            'password' => 'required|min:8',
        ], [
            'email.required' => 'Alamat email tidak boleh kosong!',
            'email.min' => 'Alamat email tidak dikenal!',
            'email.email' => 'Alamat email tidak dikenal!',
            'email.max' => 'Alamat email tidak dikenal!',
            'password.required' => 'Password tidak boleh kosong!',
            'password.min' => 'Password tidak boleh kurang dari 8 karakter!',
        ]);

        // Autentikasi
        if (Auth::guard('users')->attempt([
            'email' => $this->email,
            'password' => $this->password
        ])) {
            session()->regenerate();

            $user = Auth::guard('users')->user();

            if (empty($user->phone) || empty($user->country) || empty($user->born) || empty($user->avatar)) {
                return redirect()->route('profile.update');
            } else {
                return redirect()->intended(route('index'));
            }
        } else {
            $this->dispatch('errorLogin');
        }
    }

    public function render()
    {
        return view('livewire.auth.login-user');
    }
}
