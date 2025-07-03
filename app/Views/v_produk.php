<?= $this->extend('layout') ?>
<?= $this->section('content') ?> 
<style>
    /* Card effect for table */
    .table.datatable {
        background: #fff0f6;
        border-radius: 1.2rem;
        box-shadow: 0 4px 24px rgba(244,114,182,0.10);
        border: 1.5px solid #f9a8d4;
        overflow: hidden;
    }
    .table thead {
        background: linear-gradient(135deg, #f472b6, #f9a8d4);
        color: #fff;
        font-weight: 700;
        font-size: 1.1rem;
    }
    .table tbody tr:hover {
        background: #fce7f3;
        transition: background 0.2s;
    }
    .btn-primary, .btn-success {
        border-radius: 2rem;
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(244,114,182,0.10);
        transition: background 0.2s, box-shadow 0.2s;
    }
    .btn-primary {
        background: linear-gradient(135deg, #f472b6, #f9a8d4);
        border: none;
    }
    .btn-primary:hover {
        background: linear-gradient(135deg, #be185d, #f472b6);
        box-shadow: 0 4px 16px rgba(244,114,182,0.18);
    }
    .btn-success {
        background: linear-gradient(135deg, #22c55e, #f472b6);
        border: none;
    }
    .btn-success:hover {
        background: linear-gradient(135deg, #16a34a, #be185d);
        box-shadow: 0 4px 16px rgba(244,114,182,0.18);
    }
    .btn-danger {
        border-radius: 2rem;
        font-weight: 600;
        background: linear-gradient(135deg, #f43f5e, #f472b6);
        border: none;
    }
    .btn-danger:hover {
        background: linear-gradient(135deg, #be185d, #f43f5e);
    }
    .modal-content {
        border-radius: 1.2rem;
        box-shadow: 0 4px 24px rgba(244,114,182,0.12);
        border: 1.5px solid #f9a8d4;
    }
    .modal-header, .modal-footer {
        background: #fff0f6;
        border-bottom: 1px solid #f9a8d4;
        border-top-left-radius: 1.2rem;
        border-top-right-radius: 1.2rem;
    }
    .modal-title {
        color: #be185d;
        font-weight: 700;
    }
    .form-control:focus {
        border-color: #f472b6;
        box-shadow: 0 0 0 0.2rem rgba(244,114,182,0.15);
    }
    .form-group label {
        color: #be185d;
        font-weight: 600;
    }
    .alert-info {
        background: linear-gradient(135deg, #f9a8d4, #f472b6);
        color: #fff;
        border: none;
    }
    .alert-danger {
        background: linear-gradient(135deg, #f43f5e, #f472b6);
        color: #fff;
        border: none;
    }
</style>
<?php
if (session()->getFlashData('success')) {
?>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}
?>
<?php
if (session()->getFlashData('failed')) {
?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('failed') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}
?>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
    Tambah Data
</button>
<a type="button" class="btn btn-success" href="<?= base_url() ?> produk/download">
    Download Data
</a>
<!-- Table with stripped rows -->
<table class="table datatable">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">Harga</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Foto</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($product as $index => $produk) : ?>
            <tr>
                <th scope="row"><?php echo $index + 1 ?></th>
                <td><?php echo $produk['nama'] ?></td>
                <td><?php echo $produk['harga'] ?></td>
                <td><?php echo $produk['jumlah'] ?></td>
                <td>
                    <?php if ($produk['foto'] != '' and file_exists("img/" . $produk['foto'] . "")) : ?>
                        <img src="<?php echo base_url() . "img/" . $produk['foto'] ?>" width="100px">
                    <?php endif; ?>
                </td>
                <td>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editModal-<?= $produk['id'] ?>">
                        Ubah
                    </button>
                    <a href="<?= base_url('produk/delete/' . $produk['id']) ?>" class="btn btn-danger" onclick="return confirm('Yakin hapus data ini ?')">
                        Hapus
                    </a>
                </td>
            </tr>
            <!-- Edit Modal Begin -->
            <div class="modal fade" id="editModal-<?= $produk['id'] ?>" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="<?= base_url('produk/edit/' . $produk['id']) ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" name="nama" class="form-control" id="nama" value="<?= $produk['nama'] ?>" placeholder="Nama Barang" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Harga</label>
                                    <input type="text" name="harga" class="form-control" id="harga" value="<?= $produk['harga'] ?>" placeholder="Harga Barang" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Jumlah</label>
                                    <input type="text" name="jumlah" class="form-control" id="jumlah" value="<?= $produk['jumlah'] ?>" placeholder="Jumlah Barang" required>
                                </div>
                                <img src="<?php echo base_url() . "img/" . $produk['foto'] ?>" width="100px">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="check" name="check" value="1">
                                    <label class="form-check-label" for="check">
                                        Ceklis jika ingin mengganti foto
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="name">Foto</label>
                                    <input type="file" class="form-control" id="foto" name="foto">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Edit Modal End -->
        <?php endforeach ?>
    </tbody>
</table>
<!-- End Table with stripped rows --> 
<!-- Add Modal Begin -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('produk') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Barang" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Harga</label>
                        <input type="text" name="harga" class="form-control" id="harga" placeholder="Harga Barang" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Jumlah</label>
                        <input type="text" name="jumlah" class="form-control" id="jumlah" placeholder="Jumlah Barang" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Foto</label>
                        <input type="file" class="form-control" id="foto" name="foto">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Add Modal End -->
<?= $this->endSection() ?>