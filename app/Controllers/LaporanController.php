<?php

namespace App\Controllers;

use App\Models\LaporanModel;
use App\Models\TransactionDetailModel;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class LaporanController extends BaseController
{
    protected $laporan;

    public function __construct()
    {
        helper('number');
        $this->laporan = new LaporanModel();
        $this->detail = new TransactionDetailModel(); // tambahkan
    }

    public function index()
    {
        $start = $this->request->getGet('start');
        $end = $this->request->getGet('end');
    
        $builder = $this->laporan->where('status', 3);
    
        if ($start && $end) {
            $builder->where('DATE(created_at) >=', $start)
                    ->where('DATE(created_at) <=', $end);
        }
    
        $data['laporan'] = $builder->findAll();
    
        return view('v_laporan', $data);
    }
    
    public function download()
    {
        $laporan = $this->laporan->where('status', 3)->findAll();
        $detailProduk = [];
    
        foreach ($laporan as $row) {
            $detailProduk[$row['id']] = $this->detail
                ->select('transaction_detail.*, product.nama')
                ->join('product', 'transaction_detail.product_id = product.id')
                ->where('transaction_id', $row['id'])
                ->findAll();
        }
    
        $html = view('v_laporanPDF', [
            'laporan' => $laporan,
            'produk' => $detailProduk
        ]);
    
        $filename = 'laporan-penjualan-' . date('Y-m-d-H-i-s');
    
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream($filename);
    }  

    public function exportExcel()
    {
        $start = $this->request->getGet('start');
        $end = $this->request->getGet('end');
    
        $builder = $this->laporan->where('status', 3);
        if ($start && $end) {
            $builder->where('DATE(created_at) >=', $start)
                    ->where('DATE(created_at) <=', $end);
        }
    
        $laporan = $builder->findAll();
    
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Laporan Penjualan');
    
        // Header
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'ID Transaksi');
        $sheet->setCellValue('C1', 'Username');
        $sheet->setCellValue('D1', 'Tanggal');
        $sheet->setCellValue('E1', 'Total Bayar');
    
        // Data
        $i = 2;
        foreach ($laporan as $key => $row) {
            $sheet->setCellValue('A' . $i, $key + 1);
            $sheet->setCellValue('B' . $i, $row['id']);
            $sheet->setCellValue('C' . $i, $row['username']);
            $sheet->setCellValue('D' . $i, $row['created_at']);
            $sheet->setCellValue('E' . $i, $row['total_harga']);
            $i++;
        }
    
        // Output
        $filename = 'Laporan-Penjualan-' . date('YmdHis') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$filename\"");
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit();
    }
    
}
