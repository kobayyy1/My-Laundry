<?php

namespace App\Http\Controllers\admin;

use App\Models\admins;
use App\Http\Controllers\Controller;

class profileAdminController extends Controller
{
    public function index()
    {
        return view('admin.profile.index');
    }

      public function admindetail($id)
    {
        $data = admins::find($id);
        return view('admin.profile.detail', [
            'data' => $data
        ]);
    }
}
