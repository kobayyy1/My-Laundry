<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;


class userOrderController extends Controller
{
    public function order()
    {
        // dd('INV/' . now()->format('ymd') . '/' . strtoupper(Str::random(6)));
        return view('user.order');
    }
}
