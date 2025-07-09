<?php

namespace App\Http\Controllers;

use App\Models\product;

class indexController extends Controller
{
    public function index()
    {

   

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
        $data = product::all();

        return view('pages.product', [
            'product' => $data
        ]);
    }
    public function tentang()
    {
        return view('pages.aboutlink.tentang');
    }

    public function layanan()
    {
        return view('pages.aboutlink.layanan');
    }
    public function kerja()
    {
        return view('pages.aboutlink.carakerja');
    }
    public function faq()
    {
        return view('pages.aboutlink.faq');
    }
    public function kontak()
    {
        return view('pages.aboutlink.kontak');
    }
    public function keunggulan()
    {
        return view('pages.aboutlink.keunggulan');
    }


}
