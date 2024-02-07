<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CustomersModel;
use App\Models\TransactionModel;
use App\Models\TransactionProductModel;
use App\Models\Products\ItemsModel;


class Transaction extends BaseController
{
    protected $customersModel;
    protected $transactionModel;
    protected $transactionProductModel;
    protected $itemsModel;


    public function __construct()
    {
        $this->customersModel = new CustomersModel();
        $this->transactionModel = new TransactionModel();
        $this->transactionProductModel = new TransactionProductModel();
        $this->itemsModel = new ItemsModel();;
    }

    public function index()
    {
        $invoice = $this->transactionModel->invoiceAutomaticByDate();
        $transactionProdcuts = $this->transactionProductModel->getTransactionProduct($invoice);
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'barcode' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} is required',
                    ]
                ],
                'quantity' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} is required'
                    ]
                ]
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $itemsBarcode = $this->request->getVar('barcode');
                $qtyProduct = $this->request->getVar('quantity');
                $transactionProduct = $this->transactionProductModel->where('items_barcode', $itemsBarcode)->where('transaction_invoice', $invoice)->first();
                $itemsProduct = $this->itemsModel->where('barcode', $itemsBarcode)->first();

                if (!$itemsProduct) {
                    $this->sessions->setFlashdata('error', 'Barcode not found');
                    return redirect()->to('/transaction')->withInput();
                }

                if ($qtyProduct > $itemsProduct['stock']) {
                    $this->sessions->setFlashdata('error', 'Quantity exceeds stock');
                    return redirect()->to('/transaction')->withInput();
                }

                if ($transactionProduct) {
                    $data = [
                        'qty_product' => $transactionProduct['qty_product'] + $qtyProduct
                    ];
                    $this->transactionProductModel->updateData($itemsBarcode, $data);
                } else {
                    $data = [
                        'transaction_invoice' =>  $invoice,
                        'items_barcode' => $itemsBarcode,
                        'qty_product' => $qtyProduct
                    ];
                    $this->transactionProductModel->insertData($data);
                }
                $this->sessions->setFlashdata('success', 'Transaction successfully added');
                return redirect()->to('/transaction')->withInput();
            }
        }

        $data = [
            'title' => 'Transaction',
            'customers' => $this->customersModel->getCustomers(),
            'items' => $this->itemsModel->getItem(),
            'transactionProduct' => $transactionProdcuts,
            'transactionTotal' => $this->transactionProductModel->sumSubTotal($invoice),
            'validation' => \Config\Services::validation(),
            'invoice' => $invoice
        ];
        return view('pages/transaction/index', $data);
    }

    public function delete($itemsBarcode)
    {
        $this->transactionProductModel->deleteData($itemsBarcode);
        $this->sessions->setFlashdata('success', 'Transaction successfully deleted');
        return redirect()->to('/transaction');
    }

    public function proccess()
    {

        $invoice = $this->transactionModel->invoiceAutomaticByDate();
        $itemProducts = $this->itemsModel->getItem();
        $transactionProduct = $this->transactionProductModel->getTransactionProduct($invoice);
        $transactionTotal = $this->transactionProductModel->sumSubTotal($invoice);
        $customer = $this->request->getVar('customer_id');
        $userId = $this->sessions->get('id');
        $cash = $this->request->getVar('cash');
        $discount = $this->request->getVar('discount');
        $note = $this->request->getVar('note');
        $transactionCustomer = $this->customersModel->where('id', $customer)->first();

        $cash = str_replace('.', '', $cash);
        $transactionTotal = str_replace('.', '', $transactionTotal);
        if (!$transactionProduct) {
            $this->sessions->setFlashdata('error', 'Transaction is empty');
            return redirect()->to('/transaction')->withInput();
        }

        if (!$transactionCustomer) {
            $this->sessions->setFlashdata('error', 'Customer not found');
            return redirect()->to('/transaction')->withInput();
        }

        if ($cash < $transactionTotal) {
            $this->sessions->setFlashdata('error', 'Cash is not enough');
            return redirect()->to('/transaction')->withInput();
        }


        if ($discount > 0) {
            $total = $transactionTotal - $discount;
        } else {
            $total = $transactionTotal;
        }

        $change = $cash - $total;
        $data = [
            'invoice' => $invoice,
            'customer_id' => $customer,
            'user_id' => $userId,
            'total' => $transactionTotal,
            'discount' => $discount,
            'sub_total' => $total,
            'cash' => $cash,
            'change' => $change,
            'note' => $note
        ];

        foreach ($transactionProduct as $tp) {
            foreach ($itemProducts as $ip) {
                if ($tp['items_barcode'] == $ip['barcode']) {
                    $dataStock = [
                        'stock' => $ip['stock'] - $tp['qty_product']
                    ];
                    $this->itemsModel->update($ip['barcode'], $dataStock);
                }
            }
        }

        $this->transactionModel->save($data);
        // get data invoice last transaction
        $transaction = $this->transactionModel->getTransaction($invoice);
        return redirect()->to('/transaction/printout/' . $transaction['invoice'])->withInput();
    }


    public function printout($invoice)
    {
        $transaction = $this->transactionModel->getTransaction($invoice);
        $transactionProduct = $this->transactionProductModel->getTransactionProduct($invoice);
        $data = [
            'title' => 'Transaction Print Out',
            'transaction' => $transaction,
            'transactionProduct' => $transactionProduct
        ];
        return view('pages/transaction/printout', $data);
    }
}
