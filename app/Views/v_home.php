<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<style>
    .home-card-row {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
        justify-items: center;
    }
    .home-card {
        background: #fff0f6;
        border-radius: 1.5rem;
        box-shadow: 0 4px 24px rgba(244,114,182,0.10);
        border: 1.5px solid #f9a8d4;
        margin-bottom: 2rem;
        width: 100%;
        max-width: 300px;
        display: flex;
        flex-direction: column;
        align-items: center;
        transition: transform 0.18s, box-shadow 0.18s;
        position: relative;
    }
    .home-card:hover {
        transform: translateY(-8px) scale(1.03);
        box-shadow: 0 8px 32px rgba(244,114,182,0.18);
    }
    .home-card-body {
        padding: 2rem 1.5rem 1.5rem 1.5rem;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .home-card img {
        display: block;
        margin: 0 auto 1.2rem auto;
        border-radius: 1rem;
        width: 200px;
        height: 200px;
        object-fit: cover;
        box-shadow: 0 2px 12px rgba(244,114,182,0.10);
        background: #fff;
    }
    .home-card-title {
        color: #be185d;
        font-weight: 700;
        font-size: 1.2rem;
        margin-bottom: 0.5rem;
        text-align: center;
    }
    .home-card-price {
        color: #f43f5e;
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 1rem;
        text-align: center;
    }
    .btn-info {
        background: linear-gradient(135deg, #f472b6, #f9a8d4);
        color: #fff;
        font-weight: 700;
        border-radius: 2rem;
        border: none;
        padding: 0.5rem 2rem;
        box-shadow: 0 2px 8px rgba(244,114,182,0.10);
        transition: background 0.2s, box-shadow 0.2s;
    }
    .btn-info:hover {
        background: linear-gradient(135deg, #be185d, #f472b6);
        color: #fff;
        box-shadow: 0 4px 16px rgba(244,114,182,0.18);
    }
    .best-seller-label {
        position: absolute;
        top: 16px;
        left: 16px;
        background: linear-gradient(135deg, #f43f5e, #f9a8d4);
        color: #fff;
        font-size: 0.95rem;
        font-weight: 700;
        padding: 0.3rem 1rem;
        border-radius: 1rem;
        box-shadow: 0 2px 8px rgba(244,114,182,0.10);
        z-index: 2;
        letter-spacing: 1px;
    }
    @media (max-width: 992px) {
        .home-card-row {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    @media (max-width: 600px) {
        .home-card-row {
            grid-template-columns: 1fr;
        }
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
<div class="home-card-row">
    <?php foreach ($product as $key => $item) : ?>
        <?= form_open('keranjang') ?>
        <?php
        echo form_hidden('id', $item['id']);
        echo form_hidden('nama', $item['nama']);
        echo form_hidden('harga', $item['harga']);
        echo form_hidden('foto', $item['foto']);
        ?>
        <div class="home-card">
            <?php if (!empty($item['is_best_seller'])) : ?>
                <div class="best-seller-label">Best Seller</div>
            <?php endif; ?>
            <div class="home-card-body">
                <img src="<?php echo base_url() . "img/" . $item['foto'] ?>" alt="...">
                <div class="home-card-title"><?php echo $item['nama'] ?></div>
                <div class="home-card-price"><?php echo number_to_currency($item['harga'], 'IDR') ?></div>
                <button type="submit" class="btn btn-info">Beli</button>
            </div>
        </div>
        <?= form_close() ?>
    <?php endforeach ?>
</div>
<?= $this->endSection() ?>