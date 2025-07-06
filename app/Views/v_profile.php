<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<style>
    .profile-card {
        background: #fff0f6;
        border-radius: 1.5rem;
        box-shadow: 0 4px 24px rgba(244,114,182,0.10);
        border: 1.5px solid #f9a8d4;
        margin-bottom: 2rem;
        padding: 2rem 1.5rem;
        max-width: 1100px;
        margin-left: auto;
        margin-right: auto;
    }
    .profile-table th, .profile-table td {
        vertical-align: middle;
        text-align: center;
    }
    .profile-btn-detail {
        background: linear-gradient(135deg, #f472b6, #f9a8d4);
        color: #fff;
        border: none;
        border-radius: 2rem;
        font-weight: 700;
        box-shadow: 0 2px 8px rgba(244,114,182,0.10);
        padding: 0.375rem 1.5rem;
    }
    .modal-content {
        border-radius: 1.2rem;
        border: 1.5px solid #f9a8d4;
    }
    .modal-header {
        background: linear-gradient(135deg, #f472b6, #f9a8d4);
        color: #fff;
        border-top-left-radius: 1.2rem;
        border-top-right-radius: 1.2rem;
    }
</style>

<div class="profile-card">
    History Transaksi Pembelian <strong><?= $username ?></strong>
    <hr>
    <div class="table-responsive">
        <table class="table profile-table datatable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ID Pembelian</th>
                    <?php if (session()->get('role') === 'admin'): ?>
                        <th>Nama Customer (Username)</th>
                    <?php endif; ?>
                    <th>Waktu Pembelian</th>
                    <th>Total Bayar</th>
                    <th>Alamat</th>
                    <th>Status</th>
                    <th>Bukti Pembayaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($buy)) : ?>
                    <?php foreach ($buy as $index => $item) :
                        // ADMIN tidak perlu lihat transaksi admin sendiri
                        if (session()->get('role') === 'admin' && $item['username'] === 'admin') continue;
                    ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= $item['id'] ?></td>
                            <?php if (session()->get('role') === 'admin'): ?>
                                <td><?= $item['username'] === 'admin' ? 'ADMIN' : esc($item['username']) ?></td>
                            <?php endif; ?>
                            <td><?= $item['created_at'] ?></td>
                            <td><?= number_to_currency($item['total_harga'], 'IDR') ?></td>
                            <td><?= $item['alamat'] ?></td>
                            <td>
                                <?= [0 => 'Menunggu Pembayaran', 1 => 'Sudah Dibayar', 2 => 'Sedang Dikirim', 3 => 'Sudah Selesai', 4 => 'Dibatalkan'][$item['status']] ?? 'Status Tidak Diketahui' ?>
                            </td>
                            <td>
                    <?php if (session()->get('role') !== 'admin' && $item['status'] == 0): ?>
                        <form action="<?= base_url('upload-bukti/' . $item['id']) ?>" method="post" enctype="multipart/form-data">
                            <input type="file" name="bukti_pembayaran" accept="image/*" required class="form-control mb-1">
                            <button class="btn btn-sm btn-primary">Upload</button>
                        </form>
                    <?php elseif (!empty($item['bukti_pembayaran']) && file_exists("uploads/bukti/" . $item['bukti_pembayaran'])): ?>
                        <a href="<?= base_url("uploads/bukti/" . $item['bukti_pembayaran']) ?>" target="_blank">Lihat Bukti</a>
                    <?php else: ?>
                        <em>-</em>
                    <?php endif; ?>
                </td>
                <td>
                    <button type="button" class="profile-btn-detail" data-bs-toggle="modal" data-bs-target="#detailModal-<?= $item['id'] ?>">
                        Detail
                    </button>
                </td>
            </tr>

                        <!-- Modal Detail -->
                        <div class="modal fade" id="detailModal-<?= $item['id'] ?>" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Detail Transaksi</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <?php if (!empty($product[$item['id']])) :
                                            foreach ($product[$item['id']] as $i => $item2) : ?>
                                                <?= $i + 1 ?>)
                                                <?php if (!empty($item2['foto']) && file_exists("img/" . $item2['foto'])): ?>
                                                    <img src="<?= base_url("img/" . $item2['foto']) ?>" width="100px">
                                                <?php endif; ?>
                                                <strong><?= $item2['nama'] ?></strong><br>
                                                <?= number_to_currency($item2['harga'], 'IDR') ?> x <?= $item2['jumlah'] ?> pcs<br>
                                                <?= number_to_currency($item2['harga'] * $item2['jumlah'], 'IDR') ?>
                                                <hr>
                                        <?php endforeach; endif; ?>
                                        <p>Ongkir: <?= number_to_currency($item['ongkir'], 'IDR') ?></p>
                                        <p><strong>Status:</strong> <?= [0 => 'Menunggu Pembayaran', 1 => 'Sudah Dibayar', 2 => 'Sedang Dikirim', 3 => 'Sudah Selesai', 4 => 'Dibatalkan'][$item['status']] ?? 'Status Tidak Diketahui' ?></p>

                                        <?php if (!empty($item['bukti_pembayaran']) && file_exists("uploads/bukti/" . $item['bukti_pembayaran'])): ?>
                                            <p><strong>Bukti Pembayaran:</strong></p>
                                            <img src="<?= base_url("uploads/bukti/" . $item['bukti_pembayaran']) ?>" width="100%">
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal -->
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
