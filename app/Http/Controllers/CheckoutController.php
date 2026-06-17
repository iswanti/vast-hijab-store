<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Notification;

class CheckoutController extends Controller
{
    // CHECKOUT SATU ITEM
    public function process($id)
    {
        $cart = Cart::with('product')
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        $invoice =
            'INV-' .
            now()->format('YmdHis');

        $total =
            $cart->product->harga *
            $cart->qty;

        $order = Order::create([

            'user_id' => auth()->id(),

            'invoice' => $invoice,

            'total' => $total,

            'status' => 'Menunggu Konfirmasi'

        ]);
        Notification::create([

        'user_id' => auth()->id(),

        'role' => 'admin',

        'title' => 'Pesanan Baru',

        'message' =>
        auth()->user()->name .
        ' melakukan checkout dengan invoice ' .
        $invoice,

        'is_read' => false

]);
        OrderDetail::create([

            'order_id' => $order->id,

            'product_id' => $cart->product_id,

            'warna' => $cart->warna,

            'size' => $cart->size,

            'qty' => $cart->qty,

            'harga' => $cart->product->harga,

        ]);

        $cart->delete();

        return redirect()->route(
            'orders.detail',
            $order->id
        );
    }

    // CHECKOUT SEMUA ITEM
    public function checkoutAll()
    {
        $carts = Cart::with('product')
            ->where('user_id', auth()->id())
            ->get();

        if ($carts->count() == 0) {

            return back()->with(
                'error',
                'Keranjang kosong'
            );
        }

        $invoice =
            'INV-' .
            now()->format('YmdHis');

        $total = 0;

        foreach ($carts as $cart) {

            $total +=
                $cart->product->harga *
                $cart->qty;
        }

        $order = Order::create([

            'user_id' => auth()->id(),

            'invoice' => $invoice,

            'total' => $total,

            'status' => 'Menunggu Konfirmasi'

        ]);

        foreach ($carts as $cart) {

            OrderDetail::create([

                'order_id' => $order->id,

                'product_id' => $cart->product_id,

                'warna' => $cart->warna,

                'size' => $cart->size,

                'qty' => $cart->qty,

                'harga' => $cart->product->harga,

            ]);
        }

        Cart::where(
            'user_id',
            auth()->id()
        )->delete();

        return redirect()->route(
            'orders.detail',
            $order->id
        );
    }
}
