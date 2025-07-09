<?php

namespace App\Http\Controllers\Pages;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    public function checkout()
    {
        return view('pages.checkout');
    }
    public function ordersucces()
    {
        return view('pages.ordersucces');
    }
}
