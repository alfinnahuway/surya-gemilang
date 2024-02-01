<?php

namespace App\Controllers;

use App\Models\AuthModel;

class Users extends BaseController
{
    //
    protected $authModel;
    public function __construct()
    {
        $this->authModel = new AuthModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Users',
            'path' => $this->request->getPath(),
            'users' => $this->authModel->findAll()
        ];
        return view('pages/users/index', $data);
    }

    public function add()
    {

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} is required'
                    ]
                ],
                'username' => [
                    'rules' => 'required|is_unique[users.username]',
                    'errors' => [
                        'required' => '{field} is required',
                        'is_unique' => '{field} is already exists'
                    ]
                ],
                'email' => [
                    'rules' => 'required|is_unique[users.email]',
                    'errors' => [
                        'required' => '{field} is required',
                        'is_unique' => '{field} is already exists'
                    ]
                ],
                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} is required',
                    ]
                ],
                'password_confirm' => [
                    'rules' => 'required|matches[password]',
                    'errors' => [
                        'required' => '{field} is required',
                        'matches' => 'Password not match'
                    ]
                ],
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {

                $dataUsers = [
                    'name' => $this->request->getVar('name'),
                    'username' => $this->request->getVar('username'),
                    'email' => $this->request->getVar('email'),
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                    'image' => 'default.png',
                    'role' => 'CASHIER'
                ];
                $this->authModel->save($dataUsers);

                session()->setFlashdata('successUsers', 'New user has been created');
                return redirect()->to('/users');
            }
        }

        $data = [
            'title' => 'Users',
            'path' => $this->request->getPath(),
            'validation' => \Config\Services::validation()
        ];
        return view('pages/users/add', $data);
    }
}
