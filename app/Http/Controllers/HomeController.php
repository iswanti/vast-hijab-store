<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | LANDING USER
    |--------------------------------------------------------------------------
    */
   
    public function home()
{

    $products = Product::latest()
        ->paginate(8);

    $brands = Product::select('brand')
        ->distinct()
        ->get();

    return view('user.home', compact(
        'products',
        'brands'
    ));
}


    /*
    |--------------------------------------------------------------------------
    | HALAMAN KATALOG
    |--------------------------------------------------------------------------
    */

    public function katalog(Request $request)
    {

        $query = Product::query();

        /*
        |--------------------------------------------------------------------------
        | SEARCH PRODUCT
        |--------------------------------------------------------------------------
        */

        if ($request->search) {

            $query->where(function ($q) use ($request) {

                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('brand', 'like', '%' . $request->search . '%')
                  ->orWhere('warna', 'like', '%' . $request->search . '%')
                  ->orWhere('size', 'like', '%' . $request->search . '%');

            });
        }


        /*
        |--------------------------------------------------------------------------
        | FILTER BRAND
        |--------------------------------------------------------------------------
        */

        if ($request->brand && $request->brand != 'all') {

            $query->where('brand', $request->brand);

        }


        /*
        |--------------------------------------------------------------------------
        | SORTING
        |--------------------------------------------------------------------------
        */

        if ($request->sort == 'harga_terendah') {

            $query->orderBy('harga', 'asc');

        }

        elseif ($request->sort == 'harga_tertinggi') {

            $query->orderBy('harga', 'desc');

        }

        elseif ($request->sort == 'nama_az') {

            $query->orderBy('nama', 'asc');

        }

        elseif ($request->sort == 'nama_za') {

            $query->orderBy('nama', 'desc');

        }

        else {

            $query->latest();

        }


        /*
        |--------------------------------------------------------------------------
        | GET PRODUCT
        |--------------------------------------------------------------------------
        */

        $products = $query->paginate(8);


        /*
        |--------------------------------------------------------------------------
        | GET BRAND
        |--------------------------------------------------------------------------
        */

        $brands = Product::select('brand')
            ->distinct()
            ->get();


        return view('user.katalog', compact(
            'products',
            'brands'
        ));
    }



    /*
    |--------------------------------------------------------------------------
    | DETAIL PRODUCT
    |--------------------------------------------------------------------------
    */

    public function detail($id)
    {

        $product = Product::findOrFail($id);

        $relatedProducts = Product::latest()
        ->take(4)
        ->get();

        return view('user.detail', compact(
        'product',
        'relatedProducts'
    ));
    }



    /*
    |--------------------------------------------------------------------------
    | TRANSAKSI USER
    |--------------------------------------------------------------------------
    */

    public function transaksi()
    {

        return view('user.transaksi');

    }

}
