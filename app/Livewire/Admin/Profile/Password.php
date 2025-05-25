<?php

namespace App\Livewire\Admin\Profile;

use App\Models\admins;
use Livewire\Component;

class Password extends Component
{
    public $password, $confirmation;

    protected $rules = [
        'password'  => 'required',
        'confirmation'  => 'required'
    ];
    protected $messages = [
        'password.required' => 'Oops, password tidak boleh kosong!',
        'confirmation.required' => 'Oops, konfirmasi password tidak boleh kosong!',
    ];

    public function updated()
    {
        $this->validate();
    }

    public function clear()
    {
        $this->password = '';
        $this->confirmation = '';
    }

    public function setup()
    {
        $id = auth('admins')->user()->admin_id;
        if ($this->password != $this->confirmation) {
            $this->dispatch('error', 'Oops, password dan konfrimasi password tidak sama!');
        } else {
            $data = admins::find($id);
            $data->password = bcrypt($this->password);
            if ($data->save()) {
                $this->dispatch('success', 'Password berhasil dirubah!');
            } else {
                $this->dispatch('error', 'Oops, maaf database sedang sibuk!');
            }
        }
        $this->clear();
    }
    public function render()
    {
        return view('livewire.admin.profile.password');
    }
}
