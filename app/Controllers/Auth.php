<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function index()
    {
        return redirect()->to('auth/login');
    }

    public function login()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/dashboard');
        }
        return view('auth/login');
    }

    public function authenticate()
    {
        $userModel = new UserModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            $sessionData = [
                'user_id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'isAdmin' => $user['admin'],
                'logged_in' => TRUE
            ];
            session()->set($sessionData);
            return redirect()->to('/dashboard');
        }

        session()->setFlashdata('error', 'Invalid login credentials');
        return redirect()->back();
    }

    public function register()
    {
        return view('auth/register');
    }

    public function store()
    {
        $userModel = new UserModel();
        
        $rules = [
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'confirm_password' => 'required|matches[password]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
        ];

        $userModel->save($data);
        session()->setFlashdata('success', 'Registration successful. Please login.');
        return redirect()->to('auth/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('auth/login');
    }
} 