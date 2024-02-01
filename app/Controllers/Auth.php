<?php

namespace App\Controllers;

use App\Models\AuthModel;

class Auth extends BaseController
{
    //
    protected $authModel;
    public function __construct()
    {
        $this->authModel = new AuthModel();
    }



    public function index()
    {
        helper(['form']);
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'username' => [
                    'rules' => 'required|is_not_unique[users.username]',
                    'errors' => [
                        'required' => '{field} is required',
                        'is_not_unique' => '{field} is not match'
                    ]
                ],
                'password' => 'required',
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $username = $this->request->getVar('username');
                $password = $this->request->getVar('password');
                $data = $this->authModel->getUser($username);
                if ($data) {
                    $pass = password_verify($password, $data['password']);
                    if ($pass) {
                        $ses_data = [
                            'id' => $data['id'],
                            'name' => $data['name'],
                            'email' => $data['email'],
                            'image' => $data['image'],
                            'role' => $data['role'],
                            'logged_in' => TRUE
                        ];
                        $session = session();
                        $session->set($ses_data);
                        $session->setFlashdata('success', 'Successfully Login');
                        $session->remove('wrong_pass');
                        return redirect()->to('/dashboard');
                    } else {
                        $session = $this->sessions;
                        $session->setFlashdata('wrong_pass', 'Wrong Password');
                    }
                } else {
                    $session = $this->sessions;
                    $session->setFlashdata('msg', 'Wrong edan');
                }
            }
        }

        $data = [
            'title' => 'Login',
            'validation' => \Config\Services::validation(),

        ];
        return view('login', $data);
    }


    public function logout()
    {
        $session = $this->sessions;
        $session->destroy();
        return redirect()->to('');
    }
}
