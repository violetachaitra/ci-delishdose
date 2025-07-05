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
        <!-- Table with stripped rows -->
        <table class="table profile-table datatable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ID Pembelian</th>
                    <th scope="col">Waktu Pembelian</th>
                    <th scope="col">Total Bayar</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Status</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($buy)) :
                    foreach ($buy as $index => $item) :
                ?>
                        <tr>
                            <th scope="row"><?php echo $index + 1 ?></th>
                            <td><?php echo $item['id'] ?></td>
                            <td><?php echo $item['created_at'] ?></td>
                            <td><?php echo number_to_currency($item['total_harga'], 'IDR') ?></td>
                            <td><?php echo $item['alamat'] ?></td>
                            <!-- ($item['status'] == "1") ? "Sudah Selesai" : "Belum Selesai" ?> -->
                            <td><?php echo [0 => 'Menunggu Pembayaran', 1 => 'Sudah Dibayar', 2 => 'Sedang Dikirim', 3 => 'Sudah Selesai', 4 => 'Dibatalkan'][$item['status']] ?? 'Status Tidak Diketahui' ?></td>
                            <td>
                                <button type="button" class="profile-btn-detail" data-bs-toggle="modal" data-bs-target="#detailModal-<?= $item['id'] ?>">
                                    Detail
                                </button>
                            </td>
                        </tr>
                        <!-- Detail Modal Begin -->
                        <div class="modal fade" id="detailModal-<?= $item['id'] ?>" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Detail Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <?php 
                                        if(!empty($product)){
                                            foreach ($product[$item['id']] as $index2 => $item2) : ?>
                                                <?php echo $index2 + 1 . ")" ?>
                                                <?php if ($item2['foto'] != '' and file_exists("img/" . $item2['foto'] . "")) : ?>
                                                    <img src="<?php echo base_url() . "img/" . $item2['foto'] ?>" width="100px">
                                                <?php endif; ?>
                                                <strong><?= $item2['nama'] ?></strong>
                                                <?= number_to_currency($item2['harga'], 'IDR') ?>
                                                <br>
                                                <?= "(" . $item2['jumlah'] . " pcs)" ?><br>
                                                <?= number_to_currency($item2['subtotal_harga'], 'IDR') ?>
                                                <hr>
                                            <?php 
                                            endforeach; 
                                        }
                                        ?>
                                        Ongkir <?= number_to_currency($item['ongkir'], 'IDR') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Detail Modal End -->
                <?php
                    endforeach;
                endif;
                ?>
            </tbody>
        </table>
        <!-- End Table with stripped rows -->
    </div>
</div>
<?= $this->endSection() ?>