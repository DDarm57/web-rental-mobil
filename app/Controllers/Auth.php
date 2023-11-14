<?php

namespace App\Controllers;

use App\Models\AuthModel;

class Auth extends BaseController
{
    protected $db;
    protected $authModel;
    public function __construct()
    {
        $this->authModel = new AuthModel();
        $this->db      = \Config\Database::connect();
    }
    public function login()
    {
        $data = [
            'tittle' => 'LOGIN ADMIN',
            'validation' => \Config\Services::validation()
        ];

        return view('auth/login', $data);
    }

    public function cek_login()
    {
        if (!$this->validate([
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'username harus di isi'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'password harus di isi'
                ]
            ]

        ])) {
            return redirect()->to(site_url('auth/login'))->withInput();
        }

        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $cek = $this->authModel->loginAdmin($username, $password);

        if ($cek) {
            session()->set('log', true);
            session()->set('username', $cek['username']);
            session()->set('password', $cek['password']);
            session()->set('full_name', $cek['full_name']);
            session()->set('user_image', $cek['user_image']);

            return redirect()->to(site_url('admin/dashboard'));
        } else {
            session()->setFlashdata('pesan_merah', 'username atau password salah');
            return redirect()->to(site_url('auth/login'));
        }
    }

    public function logout()
    {
        session()->remove('log', false);
        session()->remove('username');
        session()->remove('password');
        session()->remove('full_name');
        session()->remove('user_image');

        session()->setFlashdata('pesan_hijau', 'logout Berhasil');
        return redirect()->to(site_url('auth/login'));
    }
}
