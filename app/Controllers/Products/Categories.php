<?php

namespace App\Controllers\Products;

use App\Controllers\BaseController;
use App\Models\Products\CategoriesModel;


class Categories extends BaseController
{

    protected $categoriesModel;

    public function __construct()
    {
        $this->categoriesModel = new CategoriesModel();
    }

    public function index()
    {
        $categories = $this->categoriesModel->findAll();
        $data = [
            'title' => 'Products',
            'categories' => $categories
        ];
        return view('pages/products/categories/index', $data);
    }
    public function add()
    {
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'category' => [
                    'rules' => 'required|is_unique[categories.category]',
                    'errors' => [
                        'required' => '{field} name is required',
                        'is_unique' => '{field} name already exist'
                    ]
                ]
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {

                $this->categoriesModel->save([
                    'category' => $this->request->getVar('category'),
                ]);
                $session = session();
                $session->setFlashdata('success', 'Category added successfully');
                return redirect()->to('/products/categories');
            }
        }
        $data = [
            'title' => 'Categories',
            'validation' => \Config\Services::validation()
        ];
        return view('pages/products/categories/add', $data);
    }

    public function edit($id)
    {
        $category = $this->categoriesModel->find($id);
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'category' => [
                    'rules' => 'required|is_unique[categories.category]',
                    'errors' => [
                        'required' => '{field} name is required',
                        'is_unique' => '{field} name already exist'
                    ]
                ]
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {

                $this->categoriesModel->save([
                    'id' => $id,
                    'category' => $this->request->getVar('category'),
                ]);
                $session = session();
                $session->setFlashdata('success', 'Category updated successfully');
                return redirect()->to('/products/categories');
            }
        }
        $data = [
            'title' => 'Categories',
            'category' => $category,
            'validation' => \Config\Services::validation()
        ];
        return view('pages/products/categories/edit', $data);
    }

    public function delete($id)
    {
        $this->categoriesModel->delete($id);
        $session = session();
        $session->setFlashdata('success', 'Category deleted successfully');
        return redirect()->to('/products/categories');
    }
}
