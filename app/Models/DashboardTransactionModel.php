<?php
namespace App\Models;

use CodeIgniter\Model;

class DashboardTransactionModel extends Model
{
    protected $table = 'transaction';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'username', 'total_harga', 'alamat', 'ongkir', 'status', 'created_at', 'updated_at', 'bukti_pembayaran'
    ];

    public function getTransactionsWithProducts()
    {
        return $this->select("transaction.*, GROUP_CONCAT(CONCAT(product.nama, ' (', transaction_detail.jumlah, ')') SEPARATOR ', ') as produk")
            ->join('transaction_detail', 'transaction_detail.transaction_id = transaction.id', 'left')
            ->join('product', 'product.id = transaction_detail.product_id', 'left')
            ->groupBy('transaction.id')
            ->orderBy('transaction.created_at', 'DESC')
            ->findAll();
    }
}
