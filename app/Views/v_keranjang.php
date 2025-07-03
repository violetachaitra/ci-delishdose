<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<style>
    .keranjang-card {
        background: #fff0f6;
        border-radius: 1.5rem;
        box-shadow: 0 4px 24px rgba(244,114,182,0.10);
        border: 1.5px solid #f9a8d4;
        margin-bottom: 2rem;
        padding: 2rem 1.5rem;
        max-width: 900px;
        margin-left: auto;
        margin-right: auto;
    }
    .keranjang-table th, .keranjang-table td {
        vertical-align: middle;
        text-align: center;
    }
    .keranjang-table img {
        border-radius: 1rem;
        width: 80px;
        height: 80px;
        object-fit: cover;
        box-shadow: 0 2px 12px rgba(244,114,182,0.10);
        background: #fff;
    }
    .keranjang-total {
        background: linear-gradient(135deg, #f472b6, #f9a8d4);
        color: #fff;
        font-weight: 700;
        border-radius: 1rem;
        padding: 1rem 2rem;
        margin: 1.5rem 0;
        text-align: right;
        font-size: 1.2rem;
        box-shadow: 0 2px 8px rgba(244,114,182,0.10);
    }
    .keranjang-btn {
        border-radius: 2rem;
        font-weight: 700;
        box-shadow: 0 2px 8px rgba(244,114,182,0.10);
        margin-right: 0.5rem;
    }
    .keranjang-btn-success {
        background: linear-gradient(135deg, #f472b6, #f9a8d4);
        color: #fff;
        border: none;
    }
    .keranjang-btn-danger {
        background: #f43f5e;
        color: #fff;
        border: none;
    }
    .keranjang-btn-warning {
        background: #f9a8d4;
        color: #be185d;
        border: none;
    }
</style>
<?php
if (session()->getFlashData('success')) {
?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}
?>
<?php echo form_open('keranjang/edit') ?>
<div class="keranjang-card">
    <!-- Table with stripped rows -->
    <table class="table keranjang-table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Foto</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            if (!empty($items)) :
                foreach ($items as $index => $item) :
            ?>
                    <tr>
                        <td><?php echo $item['name'] ?></td>
                        <td><img src="<?php echo base_url() . "img/" . $item['options']['foto'] ?>"></td>
                        <td><?php echo number_to_currency($item['price'], 'IDR') ?></td>
                        <td><input type="number" min="1" name="qty<?php echo $i++ ?>" class="form-control" value="<?php echo $item['qty'] ?>"></td>
                        <td><?php echo number_to_currency($item['subtotal'], 'IDR') ?></td>
                        <td>
                            <a href="<?php echo base_url('keranjang/delete/' . $item['rowid'] . '') ?>" class="btn keranjang-btn keranjang-btn-danger">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
            <?php
                endforeach;
            endif;
            ?>
        </tbody>
    </table>
    <!-- End Table with stripped rows -->
    <div class="keranjang-total">
        <?php echo "Total = " . number_to_currency($total, 'IDR') ?>
    </div>
    <div class="d-flex flex-wrap justify-content-end">
        <button type="submit" class="btn keranjang-btn keranjang-btn-success">Perbarui Keranjang</button>
        <a class="btn keranjang-btn keranjang-btn-warning" href="<?php echo base_url() ?>keranjang/clear">
            Kosongkan Keranjang
        </a>
        <?php if (!empty($items)) : ?>
            <a class="btn keranjang-btn keranjang-btn-success" href="<?php echo base_url() ?>checkout">Selesai Belanja</a>
        <?php endif; ?>
    </div>
</div>
<?php echo form_close() ?>
<?= $this->endSection() ?>