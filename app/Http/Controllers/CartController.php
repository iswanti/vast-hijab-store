<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([

            'qty'   => 'required|integer|min:1',
            'warna' => 'required',
            'size'  => 'required',

        ]);

        $product = Product::findOrFail($id);

        // VALIDASI STOK
        if ($request->qty > $product->stok) {

            return back()->with(
                'error',
                'Stok produk tidak mencukupi'
            );
        }

        // CEK PRODUK SUDAH ADA DI CART
        $cart = Cart::where('user_id', auth()->id())
            ->where('product_id', $id)
            ->where('warna', $request->warna)
            ->where('size', $request->size)
            ->first();

        if ($cart) {

            $cart->qty += $request->qty;

            $cart->save();

        } else {

            Cart::create([

                'user_id'    => auth()->id(),

                'product_id' => $id,

                'qty'        => $request->qty,

                'warna'      => $request->warna,

                'size'       => $request->size,

            ]);

        }

        return redirect()
            ->route('cart.index')
            ->with(
                'success',
                'Produk berhasil ditambahkan ke keranjang'
            );
    }

    public function index()
    {
        $carts = Cart::with('product')
            ->where('user_id', auth()->id())
            ->get();

        return view(
            'user.cart',
            compact('carts')
        );
    }

    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);

        if ($cart->user_id != auth()->id()) {

            abort(403);

        }

        $cart->delete();

        return back()->with(
            'success',
            'Produk berhasil dihapus dari keranjang'
        );
    }
}
