<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h4>Laporan Penjualan - Transaksi Sudah Selesai</h4>

<!-- Filter Form -->
<form action="<?= base_url('laporan-penjualan') ?>" method="get" class="row mb-3 g-3">
    <div class="col-md-3">
        <label>Dari Tanggal</label>
        <input type="date" name="start" value="<?= esc($_GET['start'] ?? '') ?>" class="form-control">
    </div>
    <div class="col-md-3">
        <label>Sampai Tanggal</label>
        <input type="date" name="end" value="<?= esc($_GET['end'] ?? '') ?>" class="form-control">
    </div>
    <div class="col-md-6 d-flex align-items-end gap-2">
        <button class="btn btn-primary" type="submit">Tampilkan</button>
        <a href="<?= base_url('laporan-penjualan/export-pdf?start=' . ($_GET['start'] ?? '') . '&end=' . ($_GET['end'] ?? '')) ?>" class="btn btn-danger">
         Download PDF
        </a>
        <a href="<?= base_url('laporan-penjualan/export-excel?start=' . ($_GET['start'] ?? '') . '&end=' . ($_GET['end'] ?? '')) ?>" class="btn btn-success">
            Export ke Excel
        </a>
    </div>
</form>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
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
                    <td><?= number_to_currency($row['total_harga'], 'IDR') ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="text-center">Tidak ada data penjualan selesai.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?= $this->endSection() ?>
