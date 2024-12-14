<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function __construct()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('auth/login');
        }
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'name' => session()->get('name'),
            'email' => session()->get('email')
        ];
        
        return view('dashboard/index', $data);
    }
} 