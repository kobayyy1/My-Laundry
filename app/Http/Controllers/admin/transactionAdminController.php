<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

class transactionAdminController extends Controller
{
    public function index()
    {
        return view('admin.transaction.index');
    }
   
}
