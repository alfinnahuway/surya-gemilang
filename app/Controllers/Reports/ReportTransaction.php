<?php

namespace App\Controllers\Reports;

use App\Controllers\BaseController;
use App\Models\TransactionModel;
use App\Models\TransactionProductModel;
use App\Models\CustomersModel;
use CodeIgniter\API\ResponseTrait;

class ReportTransaction extends BaseController
{
    use ResponseTrait;
    protected $transactionModel;
    protected $transactionProductModel;
    protected $customersModel;

    public function __construct()
    {
        $this->transactionModel = new TransactionModel();
        $this->transactionProductModel = new TransactionProductModel();
        $this->customersModel = new CustomersModel();
    }

    public function index()
    {

        $dataTransaction = $this->transactionModel->getTransactionByDate();

        // $date = $this->request->getGet('date');
        // $customer = $this->request->getGet('customer');
        $dataCustomer = $this->customersModel->findAll();

        // dd($dataTransactionProduct);
        $data = [
            'title' => 'Report Transaction',
            'transaction' => $dataTransaction,
            'customer' => $dataCustomer,

        ];
        return view('pages/reports/transaction', $data);
    }

    public function search()
    {
        if ($this->request->isAJAX()) {
            //  get data from ajax and return to javascript
            $date = $this->request->getGet('date');
            $customer = $this->request->getGet('customer');
            $dataTransaction = $this->transactionModel->getTransactionByDate($date, $customer);
            return $this->respond($dataTransaction);
        }
    }

    public function detail($invoice)
    {

        // send data to javascript
        if ($this->request->isAJAX()) {
            $dataTransactionProduct = $this->transactionProductModel->getTransactionProduct($invoice);
            return $this->respond($dataTransactionProduct);
        }
    }
}
