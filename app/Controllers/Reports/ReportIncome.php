<?php

namespace App\Controllers\Reports;

use App\Controllers\BaseController;
use App\Models\TransactionModel;
use CodeIgniter\API\ResponseTrait;

class ReportIncome extends BaseController
{
    use ResponseTrait;
    protected $transactionModel;


    public function __construct()
    {
        $this->transactionModel = new TransactionModel();
    }

    public function index()
    {
        // sum total transaction group by day
        $dataTransaction = $this->transactionModel->getTransactionByMonth();

        // dd($dataTransaction);
        $data = [
            'title' => 'Report Income',
            'transaction' => $dataTransaction

        ];
        return view('pages/reports/income', $data);
    }

    public function search()
    {
        $startDate = $this->request->getGet('startDate');
        $endDate = $this->request->getGet('endDate');
        $dataTransaction = $this->transactionModel->getTransactionByMonth($startDate, $endDate);
        $data = [
            'title' => 'Report Income',
            'transaction' => $dataTransaction,
            'startDate' => $startDate,
            'endDate' => $endDate
        ];
        return view('pages/reports/income', $data);
    }
}
