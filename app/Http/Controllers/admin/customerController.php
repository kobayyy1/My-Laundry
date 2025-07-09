<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class customerController extends Controller
{
    public function customer()
    {
        return view('admin.customer.index');
    }
        public function customerdetail($id)
    {
        $data = User::find($id);
        return view('admin.customer.detail', [
            'data' => $data
        ]);
    }
}
