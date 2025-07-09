<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class userProfileController extends Controller
{
    public function index()
    {
        $user = Auth::guard('users')->user();
        return view('user.profile', compact('user'));
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|max:2048', // max 2MB
        ]);


        try {
            $user = User::find(Auth::guard('users')->user()->user_id);
            // CHANGE_FILE_NAME
            $filename = pathinfo($request->avatar->getClientOriginalName(), PATHINFO_FILENAME);
            $image = 'IMG-' . date('YmdHis') . $filename . "." . $request->avatar->getClientOriginalExtension();
            $request->avatar->storeAs('/images/avatar', $image, 's4');
            $user->avatar = $image;
            $user->save();

            return redirect()->back()->with('success', 'Avatar berhasil diperbarui!');
        } catch (\Throwable $e) {
            Log::error('Gagal memperbarui avatar: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui avatar.');
        }
    }

      public function update()
     {
        $user = Auth::guard('users')->user(); 
        return view('user.update', compact('user'));
    }

    public function updatepost(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'gender' => 'required|in:M,F',
            'born' => 'required',
            'phone' => 'required|max:20',
            'country' => 'required',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withInput()->with('error', 'Data gagal diperbarui!');
        } else {
            $user = User::find(Auth::guard('users')->user()->user_id);
            $user->update([
                'gender' => $request->gender,
                'born' => $request->born,
                'phone' => $request->phone,
                'country' => $request->country,
            ]);

            try {
                return redirect()->route('index')->with('success', 'Profil berhasil diperbarui.');
            } catch (\Throwable $e) {
                Log::error('Gagal memperbarui profil: ' . $e->getMessage());
                return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui profil.');
            }
        }
    }


    public function logout()
    {
        if (Auth::guard('users')->check()) {
            // session()->has('notif');
            // session()->put('notif');
            Auth::guard('users')->Logout();
            return redirect()->route('index');
        }
    }
}
