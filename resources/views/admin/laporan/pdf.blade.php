<!DOCTYPE html>
<html>

<head>

    <title>
        Laporan Penjualan
    </title>

    <style>
        body {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
        }

        th {
            background: #f3f4f6;
        }
    </style>

</head>

<body>

    <h2>

        Laporan Penjualan Vast Hijab

    </h2>

    <h3>

        Total Pendapatan :
        Rp {{ number_format($totalPendapatan, 0, ',', '.') }}

    </h3>

    <table>

        <thead>

            <tr>

                <th>Invoice</th>

                <th>Customer</th>

                <th>Tanggal</th>

                <th>Total</th>

            </tr>

        </thead>

        <tbody>

            @foreach ($orders as $order)
                <tr>

                    <td>
                        {{ $order->invoice }}
                    </td>

                    <td>
                        {{ $order->user->name }}
                    </td>

                    <td>
                        {{ $order->created_at->format('d-m-Y') }}
                    </td>

                    <td>
                        Rp {{ number_format($order->total, 0, ',', '.') }}
                    </td>

                </tr>
            @endforeach

        </tbody>

    </table>

</body>

</html>
