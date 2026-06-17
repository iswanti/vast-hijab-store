<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">

    <title>Invoice</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th,
        td {
            padding: 10px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .total {
            margin-top: 20px;
            text-align: right;
            font-size: 18px;
            font-weight: bold;
        }
    </style>

</head>

<body>

    <div class="header">

        <h2>VAST HIJAB STORE</h2>

        <p>
            Invoice Penjualan
        </p>

    </div>

    <p>

        <strong>Invoice :</strong>

        {{ $order->invoice }}

    </p>

    <p>

        <strong>Tanggal :</strong>

        {{ $order->created_at->format('d-m-Y') }}

    </p>

    <p>

        <strong>Customer :</strong>

        {{ $order->user->name }}

    </p>

    <table>

        <thead>

            <tr>

                <th>Produk</th>

                <th>Warna</th>

                <th>Size</th>

                <th>Qty</th>

                <th>Harga</th>

            </tr>

        </thead>

        <tbody>

            @foreach ($order->details as $item)
                <tr>

                    <td>

                        {{ $item->product->nama }}

                    </td>

                    <td>

                        {{ $item->warna }}

                    </td>

                    <td>

                        {{ $item->size }}

                    </td>

                    <td>

                        {{ $item->qty }}

                    </td>

                    <td>

                        Rp {{ number_format($item->harga, 0, ',', '.') }}

                    </td>

                </tr>
            @endforeach

        </tbody>

    </table>

    <div class="total">

        Total :
        Rp {{ number_format($order->total, 0, ',', '.') }}

    </div>

    <br><br>

    <p>

        Status :
        {{ $order->status }}

    </p>

    @if ($order->resi)
        <p>

            Nomor Resi :
            {{ $order->resi }}

        </p>
    @endif

</body>

</html>
