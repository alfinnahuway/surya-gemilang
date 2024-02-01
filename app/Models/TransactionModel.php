<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table            = 'transaction';
    protected $allowedFields    = ['invoice', 'customer_id', 'user_id', 'total', 'discount', 'sub_total', 'cash', 'change', 'note'];
    protected $primaryKey     = 'invoice';
    protected $useAutoIncrement = false;
    // Dates
    protected $useTimestamps = true;

    public function invoiceAutomaticByDate()
    {
        $date = date('ymd');
        $query = $this->query("SELECT MAX(RIGHT(invoice, 4)) AS invoice FROM transaction WHERE DATE(created_at) = CURDATE()");
        $result = $query->getRowArray();
        $invoice = $result['invoice'];
        $noUrut = (int) substr($invoice, 0, 4);
        $noUrut++;
        $char = $date;
        $newInvoice = 'SS' . $char . sprintf("%04s", $noUrut);
        return $newInvoice;
    }

    public function getTransaction($invoice)
    {
        $query = $this->db->table('transaction')
            ->select('transaction.*, customers.full_name, users.name')
            ->join('customers', 'customers.id = transaction.customer_id')
            ->join('users', 'users.id = transaction.user_id')
            ->where('transaction.invoice', $invoice)
            ->get();
        return $query->getRowArray();
    }

    public function countTransactionByDateNow()
    {
        $query = $this->query("SELECT  COUNT(*) as count FROM transaction WHERE DATE(created_at) = CURDATE()");
        return $query->getRowArray();
    }

    public function transactionByDateNow()
    {
        $query = $this->query("SELECT invoice FROM transaction WHERE DATE(created_at) = CURDATE()");
        return $query->getResultArray();
    }

    public function sumSubTotalByDateNow()
    {
        $query = $this->query("SELECT SUM(sub_total) as sub_total FROM transaction WHERE DATE(created_at) = CURDATE()");
        $result = $query->getRowArray();
        $subTotal = $result['sub_total'];
        return $subTotal;
    }
}
