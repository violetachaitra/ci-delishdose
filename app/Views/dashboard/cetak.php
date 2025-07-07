<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard - Delishdose</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');
        @page {
            size: A4 landscape;
            margin: 0;
        }
        html, body {
            width: 297mm;
            height: 210mm;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            background: #fff0f6;
        }
        body {
            font-family: 'Poppins', Arial, sans-serif;
            color: #222;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            position: relative;
        }
        .header {
            width: 90%;
            margin: 20px auto 10px auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        .logo {
            position: absolute;
            top: 30px;
            left: 100px;
            width: 90px;
            display: block;
            margin: 0;
            z-index: 10;
        }
        .header-content {
            flex: 0 1 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        h1 {
            text-align: center;
            font-size: 38px;
            margin-bottom: 8px;
            color: #d291bc;
            letter-spacing: 1px;
        }
        p.date {
            text-align: center;
            margin-bottom: 0;
            font-size: 17px;
            color: #b5838d;
        }
        hr {
            margin: 20px 0;
            border: none;
            border-top: 3px solid #f3c4e3;
            width: 90%;
        }
        .table-container {
            width: 90%;
            margin: 0 auto 30px auto;
            box-shadow: 0 4px 16px rgba(210, 145, 188, 0.10);
            border-radius: 14px;
            overflow: hidden;
            background: #fffafd;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 15px;
        }
        th, td {
            border: 1px solid #f3c4e3;
            padding: 10px 6px;
            text-align: center;
        }
        th {
            background: linear-gradient(90deg, #f3c4e3 80%, #f9bec7 100%);
            color: #a4133c;
            font-weight: 700;
            font-size: 16px;
        }
        tr:nth-child(even) {
            background-color: #ffe0ef;
        }
        tr:hover {
            background: #f9bec7;
        }
        .footer {
            width: 90%;
            margin: 0 auto 20px auto;
            font-size: 14px;
            color: #b5838d;
            text-align: right;
        }
        .text-left {
            text-align: left;
        }
        @media print {
            html, body {
                width: 297mm;
                height: 210mm;
                min-height: 100vh;
                margin: 0;
                padding: 0;
                background: #fff0f6 !important;
            }
            .table-container, .footer, .header, hr {
                page-break-inside: avoid;
            }
        }
    </style>
</head>

<body style="min-height:100vh; margin:0; padding:0; background:#fff0f6;">
        <img src="<?= isset($logo_base64) && $logo_base64 ? $logo_base64 : '' ?>" class="logo" alt="Logo Delishdose">
        <div style="min-height:100vh; display:flex; flex-direction:column; justify-content:flex-start; align-items:center; background:#fff0f6;">
            <div class="header">      
                <div class="header-content">                
                    <h1>Dashboard - Delishdose</h1>
                    <p class="date"><?= date("l, d-m-Y H:i:s") ?> </p>
                </div>
            </div>
            <hr style="margin:30px 0 30px 0; border:none; border-top:3px solid #f3c4e3; width:100%;">
            <div class="table-container">
                <table style="width:100%; border-collapse:collapse; font-size:16px;">
                    <thead>
                        <tr>
                            <th style="background:linear-gradient(90deg,#f3c4e3 80%,#f9bec7 100%); color:#a4133c; font-weight:700; font-size:17px; padding:14px 8px;">No</th>
                            <th style="background:linear-gradient(90deg,#f3c4e3 80%,#f9bec7 100%); color:#a4133c; font-weight:700; font-size:17px; padding:14px 8px;">Username</th>
                            <th style="background:linear-gradient(90deg,#f3c4e3 80%,#f9bec7 100%); color:#a4133c; font-weight:700; font-size:17px; padding:14px 8px;">Alamat</th>
                            <th style="background:linear-gradient(90deg,#f3c4e3 80%,#f9bec7 100%); color:#a4133c; font-weight:700; font-size:17px; padding:14px 8px;">Produk</th>
                            <th style="background:linear-gradient(90deg,#f3c4e3 80%,#f9bec7 100%); color:#a4133c; font-weight:700; font-size:17px; padding:14px 8px;">Total Harga</th>
                            <th style="background:linear-gradient(90deg,#f3c4e3 80%,#f9bec7 100%); color:#a4133c; font-weight:700; font-size:17px; padding:14px 8px;">Status</th>
                            <th style="background:linear-gradient(90deg,#f3c4e3 80%,#f9bec7 100%); color:#a4133c; font-weight:700; font-size:17px; padding:14px 8px;">Tanggal Transaksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($transactions)): ?>
                        <?php $i = 1;
                        $statusOptions = [
                            0 => 'Menunggu Pembayaran',
                            1 => 'Sudah Dibayar',
                            2 => 'Sedang Dikirim',
                            3 => 'Sudah Selesai',
                            4 => 'Dibatalkan'
                        ];
                        foreach ($transactions as $row): ?>
                        <tr style="background:<?= $i%2==0?'#ffe0ef':'#fffafd' ?>;">
                            <td><?= $i++ ?></td>
                            <td><?= esc($row['username']) ?></td>
                            <td class="text-left" style="text-align:left;"><?= esc($row['alamat']) ?></td>
                            <td><?= esc($row['produk'] ?? '-') ?></td>
                            <td>Rp <?= number_format($row['total_harga'], 0, ',', '.') ?></td>
                            <td><?= $statusOptions[$row['status']] ?? $row['status'] ?></td>
                            <td><?= date('d-m-Y H:i', strtotime($row['created_at'])) ?></td>
                        </tr>
                        <?php endforeach ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="8">Tidak ada data transaksi.</td>
                        </tr>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
            <div class="footer">
                Exported by Delishdose &copy; <?= date('Y') ?> | Downloaded on <?= date('Y-m-d H:i:s') ?>
            </div>
        </div>
    </body>

</html>

<script>
    window.print();
    window.setTimeout(() => {
        window.close();
    }, 1000);
</script>