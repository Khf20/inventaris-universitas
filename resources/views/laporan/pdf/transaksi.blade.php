<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
        }

        th {
            background: #f0f0f0;
        }
    </style>
</head>
<body>
    <h1>Laporan Data Transaksi</h1>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Peminjam</th>
                <th>Jumlah</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transaksi as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->barang->nama }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>{{ $item->tgl_pinjam->format('d/m/Y') }}</td>
                    <td>{{ $item->tgl_kembali ? $item->tgl_kembali->format('d/m/Y') : '-' }}</td>
                    <td>{{ ucfirst($item->status) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Belum ada data transaksi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
