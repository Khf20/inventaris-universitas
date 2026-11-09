<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Barang</title>
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
    <h1>Laporan Data Barang</h1>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Jumlah</th>
                <th>Kondisi</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($barangs as $b)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $b->nama }}</td>
                    <td>{{ $b->kategori->nama }}</td>
                    <td>{{ $b->jumlah }}</td>
                    <td>{{ ucfirst($b->kondisi) }}</td>
                    <td>{{ $b->deskripsi ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Belum ada data barang.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>