<?php

namespace App\Http\Controllers\admin;

use App\Models\admins;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class adminController extends Controller
{
    public function index()
    {
        return view('admin.account.index');
    }

    public function create()
    {
        return view('admin.account.create');
    }

    public function createPost(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'email' => 'required|min:4|email|max:255',
            'password' => 'required|min:8|confirmed',
            'gender' => 'required',
            'born' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'is_active' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            try {
                $data = new admins();
                $data->username = $request->username;
                $data->slug = Str::slug($request->username);
                $data->email = $request->email;
                $data->password = bcrypt($request->password);
                $data->gender = $request->gender;
                $data->born = $request->born;
                $data->phone = $request->phone;
                $data->address = $request->address;
                $data->is_active = $request->is_active;

                if ($request->hasFile('image')) {
                    $validImage = Validator::make($request->all(), [
                        'image' => 'required|file|max:12288|mimes:jpg,jpeg,png,sgv',
                    ], [
                        'image.required' => 'Image tidak boleh kosong!',
                        'image.file' => 'File upload harus berupa file image',
                        'image.mimes' => 'File upload format tidak sah!',
                        'image.max' => 'File upload melebihi kapasitas!',
                    ]);
                    if ($validImage->fails()) {
                        return redirect()->back()->withInput()->withErrors($validImage)->with('error', 'Sorry somthing wrong with data!');
                    } else {
                        // CHANGE_FILE_NAME
                        $filename = pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME);
                        $image = 'IMG-' . date('YmdHis') . $filename . "." . $request->image->getClientOriginalExtension();
                        $request->image->storeAs('/images/admins', $image, 's4');
                        $data->avatar = $image;
                    }
                } else {
                    $data->avatar = "default-" . $request->gender . ".png";
                }

                $data->save();
                return redirect()->back()->with('success', 'Your data updated!');
            } catch (\Throwable $th) {
                return redirect()->back()->withInput()->with('error', 'Sorry something with update data!');
            }
        }
    }

    public function update($id)
    {
        $data = admins::find($id);
        return view('admin.account.update',[
            'data' => $data
        ]);
    }

    public function updatePost($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'gender' => 'required',
            'born' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'is_active' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            try {
                $data = admins::find($id);
                $data->username = $request->username;
                $data->slug = Str::slug($request->username);
                $data->password = bcrypt($request->password);
                $data->gender = $request->gender;
                $data->born = $request->born;
                $data->phone = $request->phone;
                $data->address = $request->address;
                $data->is_active = $request->is_active;

                if ($request->hasFile('image')) {
                    $validImage = Validator::make($request->all(), [
                        'image' => 'required|file|max:12288|mimes:jpg,jpeg,png,sgv',
                    ], [
                        'image.required' => 'Image tidak boleh kosong!',
                        'image.file' => 'File upload harus berupa file image',
                        'image.mimes' => 'File upload format tidak sah!',
                        'image.max' => 'File upload melebihi kapasitas!',
                    ]);
                    if ($validImage->fails()) {
                        return redirect()->back()->withInput()->withErrors($validImage)->with('error', 'Sorry somthing wrong with data!');
                    } else {
                        // CHANGE_FILE_NAME
                        $filename = pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME);
                        $image = 'IMG-' . date('YmdHis') . $filename . "." . $request->image->getClientOriginalExtension();
                        $request->image->storeAs('/images/admins', $image, 's4');
                        $data->avatar = $image;
                    }
                } else {
                    $data->avatar = "default-" . $request->gender . ".png";
                }

                $data->save();
                return redirect()->back()->with('success', 'Your data updated!');
            } catch (\Throwable $th) {
                return redirect()->back()->withInput()->with('error', 'Sorry something with update data!');
            }
        }
    }



    public function logout()
    {
        if (Auth::guard('admins')->check()) {
            Auth::guard('admins')->logout();
        }
        return redirect()->route('admin.login');
    }
}
