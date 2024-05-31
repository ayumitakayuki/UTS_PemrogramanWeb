<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Anggaran</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Informasi Anggaran Fakultas Ilmu Komputer Periode Mei</h2>
    <table>
        <thead>
            <tr>
                <th>Kategori Pengeluaran</th>
                <th>Alokasi Penggunaan (Rp)</th>
                <th>Penggunaan Anggaran (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <!-- Loop through products in your backend rendering -->
            @foreach($data_anggaran as $d)
            <tr>
                <td>{{ $d->kategori_pengeluaran }}</td>
                <td>{{ $d->alokasi_anggaran }}</td>
                <td>{{ $d->penggunaan_anggaran }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
