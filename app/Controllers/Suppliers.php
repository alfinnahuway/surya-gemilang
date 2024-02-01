<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SuppliersModel;

class Suppliers extends BaseController
{
    protected $suppliersModel;

    public function __construct()
    {
        $this->suppliersModel = new SuppliersModel();
    }

    public function index()
    {
        $suppliers = $this->suppliersModel->getSuppliers();
        $data = [
            'title' => 'Suppliers',
            'suppliers' => $suppliers
        ];
        return view('pages/suppliers/index', $data);
    }


    public function add()
    {

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'supplierName' => 'required',
                'phone' => 'required',
                'address' => 'required',
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $data = [
                    'supplier_company' => $this->request->getVar('supplierName'),
                    'phone' => $this->request->getVar('phone'),
                    'address' => $this->request->getVar('address'),
                    'description' => $this->request->getVar('description'),
                ];
                $this->suppliersModel->save($data);
                session()->setFlashdata('successSupplier', 'Successfully Add Supplier');
                return redirect()->to('/suppliers');
            }
        }

        $data = [
            'title' => 'Suppliers',
            'secondTitle' => 'Add Suppliers',
            'validation' => \Config\Services::validation()
        ];
        return view('pages/suppliers/add', $data);
    }

    public function edit($id)
    {
        $supplier = $this->suppliersModel->getSuppliers($id);
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'supplierName' => 'required',
                'phone' => 'required',
                'address' => 'required',
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $data = [
                    'id' => $id,
                    'supplier_company' => $this->request->getVar('supplierName'),
                    'phone' => $this->request->getVar('phone'),
                    'address' => $this->request->getVar('address'),
                    'description' => $this->request->getVar('description'),
                ];
                $this->suppliersModel->save($data);
                session()->setFlashdata('successSupplier', 'Successfully Update Supplier');
                return redirect()->to('/suppliers');
            }
        }

        $data = [
            'title' => 'Suppliers',
            'secondTitle' => 'Edit Suppliers',
            'validation' => \Config\Services::validation(),
            'supplier' => $supplier
        ];
        return view('pages/suppliers/edit', $data);
    }

    public function delete($id)
    {
        $this->suppliersModel->delete($id);
        session()->setFlashdata('successSupplier', 'Successfully Delete Supplier');
        return redirect()->to('/suppliers');
    }
}
