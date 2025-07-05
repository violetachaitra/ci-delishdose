<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\TransactionDetailModel;
use App\Models\TransactionModel;

class Home extends BaseController
{
    protected $product;
    protected $transaction;
    protected $transaction_detail;
    function __construct()
    {
        helper('form');
        helper('number');
        $this->product = new ProductModel();
        $this->transaction = new TransactionModel();
        $this->transaction_detail = new TransactionDetailModel();
    }
    public function index(): string
    {
        $product = $this->product->findAll();

        // Hitung jumlah pembelian tiap produk
        $bestSellerIds = [];
        $counts = $this->transaction_detail
            ->select('product_id, COUNT(*) as total')
            ->groupBy('product_id')
            ->having('total >', 4) // threshold best seller jadi 0, agar produk yang pernah terjual dapat label
            ->findAll();

        foreach ($counts as $row) {
            $bestSellerIds[] = $row['product_id'];
        }

        // Tandai produk best seller
        foreach ($product as &$item) {
            $item['is_best_seller'] = in_array($item['id'], $bestSellerIds);
        }
        unset($item);

        $data['product'] = $product;

        return view('v_home', $data);
    }

    public function profile()
    {
        $username = session()->get('username');
        $data['username'] = $username;

        $buy = $this->transaction->where('username', $username)->findAll();
        $data['buy'] = $buy;

        $product = [];

        if (!empty($buy)) {
            foreach ($buy as $item) {
                $detail = $this->transaction_detail->select('transaction_detail.*, product.nama, product.harga, product.foto')->join('product', 'transaction_detail.product_id=product.id')->where('transaction_id', $item['id'])->findAll();

                if (!empty($detail)) {
                    $product[$item['id']] = $detail;
                }
            }
        }

        $data['product'] = $product;

        return view('v_profile', $data);
    }

    public function contact()
    {
        $username = session()->get('username');
        $data['username'] = $username;

        return view('v_contact', $data);
    }

    public function faq()
    {
        $username = session()->get('username');
        $data['username'] = $username;

        return view('v_faq', $data);
    }

    public function penjualan()
    {
            $data['transactions'] = $this->transaction->findAll();
            return view('v_penjualan', $data);
    }
}
