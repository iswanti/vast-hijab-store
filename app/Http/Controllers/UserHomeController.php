<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class UserHomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // SEARCH
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('brand', 'like', '%' . $request->search . '%')
                  ->orWhere('warna', 'like', '%' . $request->search . '%');
            });
        }

        // FILTER BRAND
        if ($request->brand) {
            $query->where('brand', $request->brand);
        }

        $products = $query->latest()->paginate(8);

        $brands = Product::select('brand')
                    ->distinct()
                    ->pluck('brand');

        return view('user.home', compact('products', 'brands'));
    }
    public function katalog(Request $request)
    {
    $query = Product::query();

    // SEARCH
    if ($request->search) {

        $query->where('nama', 'like', '%' . $request->search . '%');

    }

    // FILTER BRAND
    if ($request->brand) {

        $query->where('brand', $request->brand);

    }

    $products = $query->latest()->paginate(8);

    $brands = Product::select('brand')
                ->distinct()
                ->pluck('brand');

    return view('user.katalog', compact('products', 'brands'));
    }

    public function transaksi()
    {
    return view('user.transaksi');
    }
}
