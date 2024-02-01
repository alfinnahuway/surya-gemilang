<?php

namespace App\Controllers\Products;

use App\Controllers\BaseController;
use App\Models\Products\UnitsModel;

class Units extends BaseController
{
    protected $unitModel;
    public function __construct()
    {
        $this->unitModel = new UnitsModel();
    }

    public function index()
    {
        $units = $this->unitModel->findAll();
        $data = [
            'title' => 'Units',
            'units' => $units
        ];
        return view('pages/products/units/index', $data);
    }

    public function add()
    {
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'unit' => [
                    'rules' => 'required|is_unique[units.name]',
                    'errors' => [
                        'required' => '{field} name is required',
                        'is_unique' => '{field} name already exist'
                    ]
                ]
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {

                $this->unitModel->save([
                    'name' => $this->request->getVar('unit'),
                ]);
                $session = session();
                $session->setFlashdata('successUnit', 'Unit added successfully');
                return redirect()->to('/products/units');
            }
        }
        $data = [
            'title' => 'Units',
            'validation' => \Config\Services::validation()
        ];
        return view('pages/products/units/add', $data);
    }

    public function edit($id)
    {
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'unit' => [
                    'rules' => 'required|is_unique[units.name]',
                    'errors' => [
                        'required' => '{field} name is required',
                        'is_unique' => '{field} name already exist'
                    ]
                ]
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {

                $this->unitModel->save([
                    'id' => $id,
                    'name' => $this->request->getVar('unit'),
                ]);
                $session = session();
                $session->setFlashdata('successUnit', 'Unit updated successfully');
                return redirect()->to('/products/units');
            }
        }
        $unit = $this->unitModel->find($id);
        $data = [
            'title' => 'Units',
            'unit' => $unit,
            'validation' => \Config\Services::validation()
        ];
        return view('pages/products/units/edit', $data);
    }

    public function delete($id)
    {
        $this->unitModel->delete($id);
        $session = session();
        $session->setFlashdata('successUnit', 'Unit deleted successfully');
        return redirect()->to('/products/units');
    }
}
