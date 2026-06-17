<!DOCTYPE html>
<html>

<head>
    <title>Laporan Penjualan</title>

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
        }
    </style>

</head>

<body>

    <h2>
        Laporan Penjualan Vast Hijab
    </h2>

    <p>
        Total Pendapatan :
        Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
    </p>

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

                    <td>{{ $order->invoice }}</td>

                    <td>{{ $order->user->name }}</td>

                    <td>{{ $order->created_at->format('d-m-Y') }}</td>

                    <td>
                        Rp {{ number_format($order->total, 0, ',', '.') }}
                    </td>

                </tr>
            @endforeach

        </tbody>

    </table>

</body>

</html>
