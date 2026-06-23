<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\OrderDetail;

class AdminController extends Controller
{
    // TAMPIL DATA ADMIN
    public function index()
    {
        $admins = User::where('role', 'admin')->get();

        return view('superadmin.admin.index', compact('admins'));
    }

    // FORM TAMBAH ADMIN
    public function create()
    {
        return view('superadmin.admin.create');
    }

    // SIMPAN ADMIN
    public function store(Request $request)
    {
        User::create([

            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin'

        ]);

        return redirect('/data-admin');
    }

    // FORM EDIT
    public function edit($id)
    {
        $admin = User::find($id);

        return view('superadmin.admin.edit', compact('admin'));
    }

    // UPDATE
    public function update(Request $request, $id)
{
    $admin = User::find($id);

    $admin->update([

        'name' => $request->name,
        'email' => $request->email,

    ]);

    return redirect('/data-admin')
        ->with('success', 'Admin berhasil diupdate');
}

    // DELETE
    public function destroy($id)
    {
        User::find($id)->delete();

        return redirect('/data-admin')
        ->with('success', 'Admin berhasil dihapus');
    }

    public function dashboard()
    {
    $totalPesanan = Order::count();

    $menunggu = Order::where(
        'status',
        'Menunggu Konfirmasi'
    )->count();

    $diproses = Order::where(
        'status',
        'Diproses'
    )->count();

    $dikirim = Order::where(
        'status',
        'Dikirim'
    )->count();

    $totalProduk = Product::count();

    $totalUser = User::where(
        'role',
        'user'
    )->count();

    $pesananTerbaru = Order::with('user')
        ->latest()
        ->take(5)
        ->get();

    return view(
        'admin.dashboard',
        compact(
        'totalPesanan',
        'menunggu',
        'diproses',
        'dikirim',
        'totalProduk',
        'totalUser',
        'pesananTerbaru',
    )
    );
    
}

public function ownerDashboard()
{
    $totalPendapatan = Order::where(
        'status',
        'Selesai'
    )->sum('total');

    $pesananSelesai = Order::where(
        'status',
        'Selesai'
    )->count();

    $totalProduk = Product::count();

    $totalUser = User::where(
        'role',
        'user'
    )->count();

    $transaksiTerbaru = Order::with('user')
        ->latest()
        ->take(5)
        ->get();

    $grafik = Order::select(
    DB::raw("EXTRACT(MONTH FROM created_at) as bulan"),
    DB::raw("SUM(total) as pendapatan")
    )
    ->where('status', 'Selesai')
    ->groupBy('bulan')
    ->orderBy('bulan')
    ->get();

    $bulan = [];
    $pendapatan = [];

    foreach ($grafik as $item) {

    $namaBulan = [
        1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',
        5=>'Mei',6=>'Jun',7=>'Jul',8=>'Agu',
        9=>'Sep',10=>'Okt',11=>'Nov',12=>'Des'
    ];

    $bulan[] = $namaBulan[$item->bulan];
    $pendapatan[] = $item->pendapatan;
    }

    $produkTerlaris = OrderDetail::select(
    'product_id',
    DB::raw('SUM(qty) as total_terjual')
    )
    ->with('product')
    ->groupBy('product_id')
    ->orderByDesc('total_terjual')
    ->take(5)
    ->get();

    return view(
        'owner.dashboard',
        compact(
            'totalPendapatan',
            'pesananSelesai',
            'totalProduk',
            'totalUser',
            'transaksiTerbaru',
            'bulan',
            'pendapatan',
            'produkTerlaris'
        )
    );
}

public function laporanPenjualanOwner(Request $request)
{
    $bulan = $request->bulan;

    $orders = Order::with('user')
        ->where('status', 'Selesai')
        ->when($bulan, function ($query) use ($bulan) {
            $query->whereMonth('created_at', $bulan);
        })
        ->latest()
        ->get();

    $totalPendapatan = $orders->sum('total');

    $totalTransaksi = $orders->count();

    $produkTerjual = OrderDetail::whereHas('order', function ($q) use ($bulan) {

        $q->where('status', 'Selesai');

        if ($bulan) {
            $q->whereMonth('created_at', $bulan);
        }

    })->sum('qty');

    return view(
        'owner.laporan.index',
        compact(
            'orders',
            'bulan',
            'totalPendapatan',
            'totalTransaksi',
            'produkTerjual'
        )
    );
}
public function exportPdf(Request $request)
{
    $bulan = $request->bulan;

    $query = Order::with('user')
        ->where('status','Selesai');

    if($bulan){

        $query->whereMonth(
            'created_at',
            $bulan
        );

    }

    $orders = $query->get();

    $totalPendapatan =
        $orders->sum('total');

    $pdf = Pdf::loadView(
        'owner.laporan.pdf',
        compact(
            'orders',
            'totalPendapatan',
            'bulan'
        )
    );

    return $pdf->download(
        'laporan-penjualan.pdf'
    );
}
public function dashboardSuperadmin()
{
    $totalAdmin = User::where(
        'role',
        'admin'
    )->count();

    $totalUser = User::where(
        'role',
        'user'
    )->count();

    $totalProduk = Product::count();

    $totalOrder = Order::count();

    $menunggu = Order::where(
        'status',
        'Menunggu Konfirmasi'
    )->count();

    $diproses = Order::where(
        'status',
        'Diproses'
    )->count();

    $dikirim = Order::where(
        'status',
        'Dikirim'
    )->count();

    $selesai = Order::where(
        'status',
        'Selesai'
    )->count();

    $dibatalkan = Order::where(
        'status',
        'Dibatalkan'
    )->count();

    $pesananTerbaru = Order::with('user')
        ->latest()
        ->take(10)
        ->get();

    $bulan = [
        'Jan',
        'Feb',
        'Mar',
        'Apr',
        'Mei',
        'Jun',
        'Jul',
        'Agu',
        'Sep',
        'Okt',
        'Nov',
        'Des'
    ];

    $jumlahTransaksi = [];

    for ($i = 1; $i <= 12; $i++) {

        $jumlahTransaksi[] = Order::whereMonth(
            'created_at',
            $i
        )->count();

    }

    return view(
        'superadmin.dashboard',
        compact(
            'totalAdmin',
            'totalUser',
            'totalProduk',
            'totalOrder',
            'menunggu',
            'diproses',
            'dikirim',
            'selesai',
            'dibatalkan',
            'bulan',
            'jumlahTransaksi',
            'pesananTerbaru'
        )
    );
}
public function laporanPenjualanAdmin(Request $request)
{
    $bulan = $request->bulan;
    $search = $request->search;

    $orders = Order::with('user')

        ->when($bulan, function ($query) use ($bulan) {

            $query->whereMonth('created_at', $bulan);

        })

        ->when($search, function ($query) use ($search) {

            $query->where(function ($q) use ($search) {

                $q->where('invoice', 'like', '%' . $search . '%')

                    ->orWhereHas('user', function ($user) use ($search) {

                        $user->where(
                            'name',
                            'like',
                            '%' . $search . '%'
                        );

                    });

            });

        })

        ->latest()
        ->get();

    $totalTransaksi = $orders->count();

    $menunggu = $orders
        ->where('status', 'Menunggu Konfirmasi')
        ->count();

    $diproses = $orders
        ->where('status', 'Diproses')
        ->count();

    $dikirim = $orders
        ->where('status', 'Dikirim')
        ->count();

    $selesai = $orders
        ->where('status', 'Selesai')
        ->count();

    return view(
        'admin.laporan.index',
        compact(
            'orders',
            'bulan',
            'search',
            'totalTransaksi',
            'menunggu',
            'diproses',
            'dikirim',
            'selesai'
        )
    );
}
}
