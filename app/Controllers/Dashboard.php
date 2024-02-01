<?php

namespace App\Controllers;

use App\Models\Products\CategoriesModel;
use App\Models\Products\ItemsModel;
use App\Models\TransactionModel;
use App\Models\TransactionProductModel;


class Dashboard extends BaseController
{
    protected $categoriesModel;
    protected $itemsModel;
    protected $transactionModel;
    protected $transactionProductModel;
    public function __construct()
    {
        $this->categoriesModel = new CategoriesModel();
        $this->itemsModel = new ItemsModel();
        $this->transactionModel = new TransactionModel();
        $this->transactionProductModel = new TransactionProductModel();
    }

    public function index()
    {
        $categories = $this->categoriesModel->findAll();
        $transactionByDateNow = $this->transactionModel->transactionByDateNow();
        $transactionCount = $this->transactionModel->countTransactionByDateNow();
        $transactionSubTotal = $this->transactionModel->sumSubTotalByDateNow();
        foreach ($transactionByDateNow as $tbd) {
            $sumTransactionProduct = $this->transactionProductModel->sumQtyByInvoice($tbd['invoice']);
        }


        $dataProduct = [];
        foreach ($categories as $category) {
            $dataProduct[] = [
                'dataGroupId' => strtolower($category['category']),
                'data' =>
                $this->itemsModel->sumQtyItems($category)
            ];
        }

        $dataCount = [];
        //    count each items base each categories by id, countAllResults() as count
        foreach ($categories as $category) {
            $dataCount[$category['category']] = [
                'value' => $this->itemsModel->where('category_id', $category['id'])->countAllResults(),
                'groupId' => strtolower($category['category'])
            ];
        }

        $data = [
            'title' => 'Dashboard',
            'categories' => $categories,
            'dataCount' => $dataCount,
            'dataProduct' => $dataProduct,
            'transactionCount' => $transactionCount,
            'productSalesToday' => $sumTransactionProduct,
            'transactionSubTotal' => $transactionSubTotal
        ];

        // dd($data);
        return view('pages/dashboard/index', $data);
    }
}
