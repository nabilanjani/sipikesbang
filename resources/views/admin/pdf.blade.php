<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Inventaris</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        .container {
            width: 100%;
            margin: 0 auto;
        }
        h1, h2 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Pengajuan Inventaris</h1>
    <h2>Bidang: {{ $groupedTransactions->first()->first()->bidang->nama_bidang ?? 'Semua' }}</h2>
    <h3>Bulan: {{ $month ?? 'Semua' }}</h3>

    <table>
        <thead>
            <tr>
                <th>Bidang</th>
                <th>Tanggal Pengajuan</th>
                <th>Nama Staf</th>
                <th>Status</th>
                <th>Item</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($groupedTransactions as $key => $transactions)
                <tr>
                    <td>{{ $transactions->first()->bidang->nama_bidang }}</td>
                    <td>{{ $transactions->first()->submission_date }}</td>
                    <td>{{ $transactions->first()->staff->nama }}</td>
                    <td>{{ $transactions->first()->status }}</td>
                    <td>
                        @foreach ($transactions as $transaction)
                            {{ $transaction->item->name }} ({{ $transaction->quantity }})
                            <br>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>
</html>
