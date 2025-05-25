<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class indexController extends Controller
{
    public function index(){

        // session()->forget('cart');
        // dd(session('cart'));

        $product = product::where('status', 1)->get();
        return view('pages.index', [
            'product' => $product
        ]);
    }

    public function about()
    {
        return view('pages.aboutme');
    }

      public function product()
    {
        $data=product::all();
        
        return view('pages.product',[
            'product'=> $data
        ] );
    }
}
