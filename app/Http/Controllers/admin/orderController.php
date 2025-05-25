<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class orderController extends Controller
{
    public function index()
    {
        return view('admin.orders.index');
    }

    public function uploadFile(Request $request)
    {
        $data = Excel::load($request->files, function($render){
            // dd();
        });
        dd($data);
        dd($request->files);
    }
}
