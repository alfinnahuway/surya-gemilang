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
            'secondTitle' => 'Users Data',
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
                'image' => [
                    'rules' => 'max_size[image,1024]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'max_size' => 'Image size is too big',
                        'is_image' => 'File is not an image',
                        'mime_in' => 'File is not an image'
                    ]
                ]
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {

                $image = $this->request->getFile('image');
                if ($image->getError() == 4) {
                    $imageName = 'default.png';
                } else {
                    $imageName = $image->getRandomName();
                    $image->move('image/users', $imageName);
                }

                $dataUsers = [
                    'name' => $this->request->getVar('name'),
                    'username' => $this->request->getVar('username'),
                    'email' => $this->request->getVar('email'),
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                    'image' => $imageName,
                    'role' => 'CASHIER'
                ];
                $this->authModel->save($dataUsers);

                session()->setFlashdata('successUsers', 'New user has been created');
                return redirect()->to('/users');
            }
        }

        $data = [
            'title' => 'Users',
            'secondTitle' => 'Users Add',
            'path' => $this->request->getPath(),
            'validation' => \Config\Services::validation()
        ];
        return view('pages/users/add', $data);
    }


    public function edit($id)
    {
        $users = $this->authModel->find($id);
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} is required'
                    ]
                ],
                'username' => [
                    'rules' => 'required|is_unique[users.username,id,' . $id . ']',
                    'errors' => [
                        'required' => '{field} is required',
                        'is_unique' => '{field} is already exists'
                    ]
                ],
                'email' => [
                    'rules' => 'required|is_unique[users.email,id,' . $id . ']',
                    'errors' => [
                        'required' => '{field} is required',
                        'is_unique' => '{field} is already exists'
                    ]
                ],
                'editImage' => [
                    'rules' => 'max_size[editImage,1024]|is_image[editImage]|mime_in[editImage,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'max_size' => 'Image size is too big',
                        'is_image' => 'File is not an image',
                        'mime_in' => 'File is not an image'
                    ]
                ]
            ];

            if ($this->request->getVar('password')) {
                if ($this->request->getVar('oldpassword')) {
                    if (!$this->authModel->verify($this->request->getVar('oldpassword'), $this->authModel->find($id)['password'])) {
                        $rules['oldpassword'] = 'required|matches[oldpassword]';
                    }
                    $rules['password'] = 'required';
                    $rules['password_confirm'] = 'required|matches[password]';
                    $password = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
                }
            } else {
                $password = $users['password'];
            }

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {

                $image = $this->request->getFile('editImage');
                if ($image->getError() == 4) {
                    $imageName = $this->request->getVar('oldImage');
                } else {
                    $imageName = $image->getRandomName();
                    $image->move('image/users', $imageName);
                    if ($this->request->getVar('oldImage') != 'default.png') {
                        unlink('image/users/' . $this->request->getVar('oldImage'));
                    }
                }

                $dataUsers = [
                    'id' => $id,
                    'name' => $this->request->getVar('name'),
                    'username' => $this->request->getVar('username'),
                    'email' => $this->request->getVar('email'),
                    'password' => $password,
                    'image' => $imageName,
                ];
                $this->authModel->save($dataUsers);

                session()->setFlashdata('successUsers', 'User has been updated');
                return redirect()->to('/users');
            }
        }
        $data = [
            'title' => 'Users',
            'secondTitle' => 'Users Edit',
            'path' => $this->request->getPath(),
            'validation' => \Config\Services::validation(),
            'users' => $users
        ];
        return view('pages/users/edit', $data);
    }
}
