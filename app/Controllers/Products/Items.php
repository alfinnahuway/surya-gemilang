<?php

namespace App\Controllers\Products;

use App\Controllers\BaseController;
use App\Models\Products\ItemsModel;
use App\Models\Products\CategoriesModel;
use App\Models\Products\UnitsModel;
use App\Models\SuppliersModel;

class Items extends BaseController
{
    protected $itemsModel;
    protected $categoriesModel;
    protected $unitsModel;
    protected $suppliersModel;

    public function __construct()
    {
        $this->itemsModel = new ItemsModel();
        $this->categoriesModel = new CategoriesModel();
        $this->unitsModel = new UnitsModel();
        $this->suppliersModel = new SuppliersModel();
    }

    public function index()
    {
        $item = $this->itemsModel->getItem();

        $data = [
            'title' => 'Products',
            'items' => $item
        ];
        return view('pages/products/items/index', $data);
    }

    public function add()
    {
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'item' => [
                    'rules' => 'required|is_unique[items.product]',
                    'errors' => [
                        'required' => '{field} name is required',
                        'is_unique' => '{field} name already exist'
                    ]
                ],
                'category' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} is required'
                    ]
                ],
                'unit' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} is required'
                    ]
                ],
                'supplier' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} is required'
                    ]
                ],
                'stock' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} is required',
                        'numeric' => '{field} must be numeric'
                    ]
                ],
                'price' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} is required',
                        'numeric' => '{field} must be numeric'
                    ]
                ],
                'product_image' => [
                    'rules' => 'max_size[product_image,1024]|is_image[product_image]|mime_in[product_image,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'max_size' => 'Max size 1MB',
                        'is_image' => 'Please choose an image',
                        'mime_in' => 'Please choose an image'
                    ]
                ]
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $barcode = $this->itemsModel->getBarcode($this->request->getVar('category'));
                $fileImage = $this->request->getFile('product_image');


                if ($fileImage->getError() == 4) {
                    $nameImage = 'default_product.jpg';
                } else {
                    $nameImage = $fileImage->getRandomName();
                    $fileImage->move('image/products', $nameImage);
                }

                $insertData = [
                    'barcode' => $barcode,
                    'product' => $this->request->getVar('item'),
                    'category_id' => $this->request->getVar('category'),
                    'unit_id' => $this->request->getVar('unit'),
                    'supplier_id' => $this->request->getVar('supplier'),
                    'stock' =>   $this->request->getVar('stock'),
                    'product_image' => $nameImage,
                    'price' => $this->request->getVar('price'),
                    'description' => $this->request->getVar('description'),
                ];

                $this->itemsModel->save($insertData);
                $session = session();
                $session->setFlashdata('successItem', 'Items added successfully');
                return redirect()->to('/products/items');
            }
        }
        $data = [
            'title' => 'Items',
            'categories' => $this->categoriesModel->findAll(),
            'units' => $this->unitsModel->findAll(),
            'suppliers' => $this->suppliersModel->getSuppliers(),
            'validation' => \Config\Services::validation()
        ];
        return view('pages/products/items/add', $data);
    }

    public function edit($barcode)
    {
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'item' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} name is required',
                    ]
                ],
                'category' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} is required'
                    ]
                ],
                'unit' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} is required'
                    ]
                ],
                'supplier' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} is required'
                    ]
                ],
                'stock' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} is required',
                        'numeric' => '{field} must be numeric'
                    ]
                ],
                'price' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} is required',
                        'numeric' => '{field} must be numeric'
                    ]
                ],
                'product_image' => [
                    'rules' => 'max_size[product_image,1024]|is_image[product_image]|mime_in[product_image,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'max_size' => 'Max size 1MB',
                        'is_image' => 'Please choose an image',
                        'mime_in' => 'Please choose an image'
                    ]
                ]
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $fileImage = $this->request->getFile('product_image');
                $oldImage = $this->request->getVar('old_image');
                if ($fileImage->getError() == 4) {
                    $nameImage = $oldImage;
                } else {
                    $nameImage = $fileImage->getRandomName();
                    $fileImage->move('image/products', $nameImage);
                    if ($oldImage != 'default_product.jpg') {
                        unlink('image/products/' . $oldImage);
                    }
                }

                $updateData = [
                    'barcode' => $barcode,
                    'product' => $this->request->getVar('item'),
                    'category_id' => $this->request->getVar('category'),
                    'unit_id' => $this->request->getVar('unit'),
                    'supplier_id' => $this->request->getVar('supplier'),
                    'stock' =>   $this->request->getVar('stock'),
                    'product_image' => $nameImage,
                    'price' => $this->request->getVar('price'),
                    'description' => $this->request->getVar('description'),
                ];

                $this->itemsModel->save($updateData);
                $session = session();
                $session->setFlashdata('successItem', 'Items updated successfully');
                return redirect()->to('/products/items');
            }
        }
        $data = [
            'title' => 'Items',
            'categories' => $this->categoriesModel->findAll(),
            'units' => $this->unitsModel->findAll(),
            'suppliers' => $this->suppliersModel->getSuppliers(),
            'item' => $this->itemsModel->find($barcode),
            'validation' => \Config\Services::validation()
        ];
        return view('pages/products/items/edit', $data);
    }

    public function delete($barcode)
    {
        // delet image and database
        $item = $this->itemsModel->find($barcode);
        if ($item['product_image'] != 'default_product.jpg') {
            unlink('image/products/' . $item['product_image']);
        }
        $this->itemsModel->delete($barcode);
        $session = session();
        $session->setFlashdata('successItem', 'Items deleted successfully');
        return redirect()->to('/products/items');
    }
}
