<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Notification;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class OrderController extends Controller
{
    // ==========================
    // USER - TRANSAKSI SAYA
    // ==========================
    public function index()
    {
        $orders = Order::with('details.product')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view(
            'user.transaksi',
            compact('orders')
        );
    }

    // ==========================
    // USER - DETAIL PESANAN (WA)
    // ==========================
    public function detail($id)
    {
        $order = Order::with([
            'user',
            'details.product'
        ])
        ->where('user_id', auth()->id())
        ->findOrFail($id);

        $admin = '6285159748894';

        $pesan =
            "Halo Admin Vast Hijab%0A%0A" .
            "Invoice : " . $order->invoice . "%0A" .
            "Nama : " . $order->user->name . "%0A%0A";

        foreach ($order->details as $detail) {

            $pesan .=
                "Produk : " . $detail->product->nama . "%0A" .
                "Warna : " . $detail->warna . "%0A" .
                "Size : " . $detail->size . "%0A" .
                "Qty : " . $detail->qty . "%0A%0A";
        }

        $pesan .=
            "Total : Rp " .
            number_format(
                $order->total,
                0,
                ',',
                '.'
            );

        $waLink =
            "https://wa.me/$admin?text=$pesan";

        return view(
            'user.order-detail',
            compact(
                'order',
                'waLink'
            )
        );
    }

    // ==========================
    // USER - DETAIL TRANSAKSI
    // ==========================
    public function transaksiDetail($id)
    {
        $order = Order::with([
            'user',
            'details.product'
        ])
        ->where('user_id', auth()->id())
        ->findOrFail($id);

        return view(
            'user.transaksi_detail',
            compact('order')
        );
    }

    // ==========================
    // ADMIN - LIST PESANAN
    // ==========================
    public function adminIndex()
    {
    $orders = Order::with([
        'user',
        'details.product'
    ])
    ->latest()
    ->paginate(10);

    return view(
    'admin.orders.index',
    compact('orders')
    );
    }

    // ==========================
    // ADMIN - DETAIL PESANAN
    // ==========================
    public function show($id)
    {
        $order = Order::with([
            'user',
            'details.product'
        ])->findOrFail($id);

        return view(
            'admin.orders.show',
            compact('order')
        );
    }

    // ==========================
    // ADMIN - KONFIRMASI
    // ==========================
   public function confirm($id)
    {
    $order = Order::with('details.product')
        ->findOrFail($id);

    foreach ($order->details as $detail) {

        $product = Product::find($detail->product_id);

        if ($product) {
            $product->stok -= $detail->qty;
            $product->save();
        }
    }

    $order->status = 'Diproses';
    $order->confirmed_at = now();

    $order->save();

    Notification::create([

    'order_id' => $order->id,

    'user_id' => $order->user_id,

    'role' => 'user',

    'title' => 'Pesanan Diproses',

    'message' =>
        'Pesanan ' .
        $order->invoice .
        ' sedang diproses oleh admin'

    ]);

    return back()->with(
        'success',
        'Pesanan berhasil dikonfirmasi'
    );
    }

    // ==========================
    // ADMIN - KIRIM PESANAN
    // ==========================
    public function kirim(Request $request, $id)
    {
    $request->validate([
        'resi' => 'required'
    ]);

    $order = Order::findOrFail($id);

    $order->resi = $request->resi;
    $order->status = 'Dikirim';
    $order->shipped_at = now();

    $order->save();

    Notification::create([

    'order_id' => $order->id,

    'user_id' => $order->user_id,

    'role' => 'user',

    'title' => 'Pesanan Dikirim',

    'message' =>
        'Pesanan ' .
        $order->invoice .
        ' telah dikirim. Resi : ' .
        $request->resi

    ]);

    return back()->with(
        'success',
        'Pesanan berhasil dikirim'
    );
    }

    // ==========================
    // ADMIN - SELESAI
    // ==========================
    public function selesai($id)
    {
    $order = Order::findOrFail($id);

    $order->status = 'Selesai';
    $order->completed_at = now();

    $order->save();

     Notification::where(
        'order_id',
        $order->id
    )->delete();

    Notification::create([

        'order_id' => $order->id,

        'user_id' => $order->user_id,

        'role' => 'user',

        'title' => 'Pesanan Selesai',

        'message' =>
            'Pesanan ' .
            $order->invoice .
            ' telah selesai'

    ]);
    return back()->with(
        'success',
        'Pesanan selesai'
    );
    }
    // ==========================
    // ADMIN - BATALKAN
    // ==========================
  public function cancel($id)
    {
    $order = Order::findOrFail($id);

    $order->status = 'Dibatalkan';
    $order->cancelled_at = now();

    $order->save();

    Notification::create([

        'user_id' => $order->user_id,

        'role' => 'user',

        'title' => 'Pesanan Dibatalkan',

        'message' =>
            'Pesanan ' .
            $order->invoice .
            ' telah dibatalkan'

    ]);

    return back()->with(
        'success',
        'Pesanan dibatalkan'
    );
    }

    public function invoice($id)
    {
    $order = Order::with([
        'user',
        'details.product'
    ])->findOrFail($id);

    $pdf = Pdf::loadView(
        'admin.orders.invoice',
        compact('order')
    );

    return $pdf->stream(
        'Invoice-' . $order->invoice . '.pdf'
    );
    }
}
