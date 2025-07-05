<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h3>Daftar Transaksi</h3>
<hr>

<?= session()->getFlashdata('success') ?>
<?= session()->getFlashdata('error') ?>

<div class="table-responsive">
    <table class="table datatable">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">UserName</th>
                <th scope="col">Total Harga</th>
                <th scope="col">Alamat</th>
                <th scope="col">Ongkir</th>
                <th scope="col">Status</th>
                <th scope="col">Ubah Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($transactions)) : ?>
                <?php foreach ($transactions as $index => $item) : ?>
                    <tr>
                        <th scope="row"><?= $index + 1 ?></th>
                        <td><?= $item['id'] ?></td>
                        <td><?= $item['username'] ?></td>
                        <td><?= number_to_currency($item['total_harga'], 'IDR') ?></td>
                        <td><?= $item['alamat'] ?></td>
                        <td><?= $item['ongkir'] ?></td>
                        <td>
                            <?= [
                                0 => 'Menunggu Pembayaran',
                                1 => 'Sudah Dibayar',
                                2 => 'Sedang Dikirim',
                                3 => 'Sudah Selesai',
                                4 => 'Dibatalkan'
                            ][$item['status']] ?? 'Status Tidak Diketahui' ?>
                        </td>
                        <td>
                            <form action="<?= base_url('penjualan/updateStatus/' . $item['id']) ?>" method="post">
                                <?= csrf_field() ?>
                                <select name="status" class="form-select form-select-sm">
                                    <option value="0" <?= $item['status'] == '0' ? 'selected' : '' ?>>Pending</option>
                                    <option value="1" <?= $item['status'] == '1' ? 'selected' : '' ?>>Paid</option>
                                    <option value="2" <?= $item['status'] == '2' ? 'selected' : '' ?>>Shipped</option>
                                    <option value="3" <?= $item['status'] == '3' ? 'selected' : '' ?>>Completed</option>
                                    <option value="4" <?= $item['status'] == '4' ? 'selected' : '' ?>>Cancelled</option>
                                </select>
                                <button type="submit" class="btn btn-success btn-sm mt-1">Update</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="8" class="text-center">Tidak ada transaksi ditemukan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>