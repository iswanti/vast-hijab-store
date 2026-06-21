<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * LIST PRODUCT
     */
    public function index(Request $request)
    {
        $query = Product::query();

        /*
        |--------------------------------------------------------------------------
        | KHUSUS ADMIN
        |--------------------------------------------------------------------------
        | Admin hanya lihat product miliknya sendiri
        */

        //if (Auth::user()->role == 'admin') {

         //   $query->where('user_id', Auth::id());

        // }

        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        if ($request->search) {

            $query->where(function ($q) use ($request) {

                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('brand', 'like', '%' . $request->search . '%')
                  ->orWhere('kode_product', 'like', '%' . $request->search . '%');

            });

        }

        /*
        |--------------------------------------------------------------------------
        | FILTER BRAND
        |--------------------------------------------------------------------------
        */

        if ($request->brand) {

            $query->where('brand', $request->brand);

        }

        /*
        |--------------------------------------------------------------------------
        | SORTING
        |--------------------------------------------------------------------------
        */

        if ($request->sort == 'nama_asc') {

            $query->orderBy('nama', 'asc');

        }

        elseif ($request->sort == 'nama_desc') {

            $query->orderBy('nama', 'desc');

        }

        elseif ($request->sort == 'harga_asc') {

            $query->orderBy('harga', 'asc');

        }

        elseif ($request->sort == 'harga_desc') {

            $query->orderBy('harga', 'desc');

        }

        else {

            $query->latest();

        }

        $products = $query->paginate(10)->withQueryString();

        $brands = Product::select('brand')
                    ->distinct()
                    ->get();

        return view('product.index', compact('products', 'brands'));
    }

    /**
     * FORM CREATE
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * STORE PRODUCT
     */
    public function store(Request $request)
    {
        $request->validate([

            'kode_product' => 'required',
            'nama' => 'required',
            'brand' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'warna' => 'required',
            'size' => 'required',
            'gambar' => 'required|image',

        ]);

        $gambar = $request->file('gambar')
                    ->store('products', 'public');

        Product::create([

           // 'user_id' => Auth::id(),

            'kode_product' => $request->kode_product,
            'nama' => $request->nama,
            'brand' => $request->brand,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'warna' => $request->warna,
            'size' => $request->size,
            'gambar' => $gambar,

        ]);

        return redirect()
                ->route('product.index')
                ->with('success', 'Product berhasil ditambahkan');
    }

    /**
     * FORM EDIT
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        //if (
        //    Auth::user()->role == 'admin' &&
        //  $product->user_id != Auth::id()
        //) {

        //    abort(403);

        //}

        return view('product.edit', compact('product'));
    }

    /**
     * UPDATE PRODUCT
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        //if (
        //  Auth::user()->role == 'admin' &&
         //   $product->user_id != Auth::id()
        //) {

          //  abort(403);

        //}

        $request->validate([

            'kode_product' => 'required',
            'nama' => 'required',
            'brand' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'warna' => 'required',
            'size' => 'required',

        ]);

        $data = [

            'kode_product' => $request->kode_product,
            'nama' => $request->nama,
            'brand' => $request->brand,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'warna' => $request->warna,
            'size' => $request->size,

        ];

        if ($request->hasFile('gambar')) {

            $gambar = $request->file('gambar')
                        ->store('products', 'public');

            $data['gambar'] = $gambar;

        }

        $product->update($data);

        return redirect()
                ->route('product.index')
                ->with('success', 'Product berhasil diupdate');
    }

    /**
     * DELETE PRODUCT
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

       // if (
         //   Auth::user()->role == 'admin' &&
           // $product->user_id != Auth::id()
        //) {

          //  abort(403);

        //}

        $product->delete();

        return redirect()
                ->route('product.index')
                ->with('success', 'Product berhasil dihapus');
    }
}
