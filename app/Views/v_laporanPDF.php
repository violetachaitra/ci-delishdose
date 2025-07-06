<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan Aylin Store</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h2 { text-align: center; margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #ddd; }
    </style>
</head>
<body>

<h2>Laporan Penjualan<br><small>Status: Sudah Selesai</small></h2>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>ID Transaksi</th>
            <th>Username</th>
            <th>Tanggal</th>
            <th>Total Bayar</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($laporan)) : ?>
            <?php foreach ($laporan as $i => $row): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= $row['id'] ?></td>
                    <td><?= esc($row['username']) ?></td>
                    <td><?= date('d M Y, H:i', strtotime($row['created_at'])) ?></td>
                    <td><?= number_format($row['total_harga'], 0, ',', '.') ?></td>
                </tr>
                <tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="5" align="center">Tidak ada data.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>
