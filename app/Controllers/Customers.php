<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CustomersModel;

class Customers extends BaseController
{
    protected $customersModel;
    public function __construct()
    {
        $this->customersModel = new CustomersModel();
    }

    public function index()
    {
        $customers = $this->customersModel->getCustomers();
        $data = [
            'title' => 'Customers',
            'customers' => $customers
        ];
        return view('pages/customers/index', $data);
    }


    public function add()
    {
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'name' => 'required',
                'phone' => 'required',
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $data = [
                    'full_name' => $this->request->getVar('name'),
                    'phone' => $this->request->getVar('phone'),
                    'address' => $this->request->getVar('address'),
                ];
                $this->customersModel->save($data);
                session()->setFlashdata('successCustomer', 'Successfully Add Customer');
                return redirect()->to('/customers');
            }
        }

        $data = [
            'title' => 'Customers',
            'secondTitle' => 'Add Customers',
            'validation' => \Config\Services::validation()
        ];
        return view('pages/customers/add', $data);
    }

    public function edit($id)
    {
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'name' => 'required',
                'phone' => 'required',
                'address' => 'required',
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $data = [
                    'id' => $id,
                    'name' => $this->request->getVar('name'),
                    'phone' => $this->request->getVar('phone'),
                    'address' => $this->request->getVar('address'),
                ];
                $this->customersModel->save($data);
                session()->setFlashdata('successCustomer', 'Successfully Edit Customer');
                return redirect()->to('/customers');
            }
        }

        $data = [
            'title' => 'Customers',
            'secondTitle' => 'Edit Customers',
            'validation' => \Config\Services::validation(),
            'customer' => $this->customersModel->getCustomers($id)
        ];
        return view('pages/customers/edit', $data);
    }

    public function delete($id)
    {
        $this->customersModel->delete($id);
        session()->setFlashdata('successCustomer', 'Successfully Delete Customer');
        return redirect()->to('/customers');
    }
}
