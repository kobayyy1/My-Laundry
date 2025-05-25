<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\product;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function index(){
        $product = product::count();
        return view('admin.home.dashboard',[
            'product' => $product
        ]);
    }
}
