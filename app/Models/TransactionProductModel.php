<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionProductModel extends Model
{
    protected $table            = 'transaction_product';
    protected $useAutoIncrement = false;
    protected $primaryKey       = 'transaction_product';
    protected $allowedFields    = ['transaction_invoice', 'items_barcode', 'qty_sales'];
    // Dates
    protected $useTimestamps = true;


    public function getTransactionProduct($invoice)
    {
        return $this->join('items', 'items.barcode = transaction_product.items_barcode')
            ->join('units', 'units.id = items.unit_id')
            ->select('transaction_product.*, items.product, items.price, units.name as unit')
            ->where('transaction_invoice', $invoice)
            ->findAll();
    }

    public function sumSubTotal($invoice)
    {
        // create query sum items.price * transaction_product.qty_product
        $query = $this->query("SELECT SUM(items.price * transaction_product.qty_product) AS sub_total FROM transaction_product JOIN items ON items.barcode = transaction_product.items_barcode WHERE transaction_invoice = '$invoice'");
        $result = $query->getRowArray();
        $subTotal = $result['sub_total'];
        return $subTotal;
    }


    public function sumQtyByInvoice($invoice = null)
    {
        $query = $this->query("SELECT SUM(qty_product) as qty FROM transaction_product WHERE transaction_invoice = '$invoice'");
        $result = $query->getRowArray();
        $qty = $result['qty'];
        if ($qty == null) {
            return 0;
        }
        return $qty;
    }


    public function insertData($data)
    {
        $this->db->table($this->table)->insert($data);
    }

    public function updateData($itemsBarcode, $data)
    {
        $this->db->table($this->table)->update($data, ['items_barcode' => $itemsBarcode]);
    }

    public function deleteData($itemsBarcode)
    {
        $this->db->table($this->table)->delete(['items_barcode' => $itemsBarcode]);
    }

    public function getTransactionProductByInvoice($invoice)
    {
        return $this->join('items', 'items.barcode = transaction_product.items_barcode')
            ->select('transaction_product.*, items.product, items.price')
            ->where('transaction_invoice', $invoice)
            ->findAll();
    }
}
