<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\orders;
use App\Models\product;
use App\Models\User;

class dashboardController extends Controller
{
    public function index()
    {
        $product = product::count();
        $orders = orders::count();
        $orderswaiting = orders::where('status', 'waiting')->get();
        $customer = User::count();


        return view('admin.home.dashboard', [
            'product' => $product,
            'orders' => $orders,
            'orderswaiting' => $orderswaiting,
            'customer' => $customer,
        ]);
    }
}
