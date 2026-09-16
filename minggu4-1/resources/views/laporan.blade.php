<!DOCTYPE html>
<html lang="id">
<head>
 <meta charset="UTF-8">
 <title>Laporan Produk</title>
</head>
<body>
    <h1>Laporan Penjualan - {{ $kategori['nama'] }}</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Terjual</th>
                <th>Tersisa</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataLaporan as $item)
            <tr>
                <td>{{ $item['nama'] }}</td>
                <td>{{ $item['terjual'] }}</td>
                <td>{{ $item['tersisa'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>