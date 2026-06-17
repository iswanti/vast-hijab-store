<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;

class WelcomeController extends Controller
{
    public function index()
    {
        // JIKA SUDAH LOGIN
        if (auth()->check()) {

            // SUPERADMIN
            if (auth()->user()->role == 'superadmin') {

                return redirect('/superadmin');

            }

            // ADMIN
            elseif (auth()->user()->role == 'admin') {

                return redirect('/admin');

            }

            // USER
            else {

                return redirect('/home');

            }
        }

        // PRODUCT UNTUK LANDING
        $products = Product::latest()->get();
        $productCount = Product::count();

        $userCount = User::where('role', 'user')->count();

        return view('welcome', compact(
            'products',
            'productCount',
            'userCount'
        ));
    }
}
