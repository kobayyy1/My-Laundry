<?php

namespace App\Http\Controllers\Pages;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function cart()
    {
        $cart = session()->get('cart', []);
        return view('pages.cart', compact('cart'));
    }
}


