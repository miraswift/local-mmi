<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data['title'] = 'Auth';
        $data['menuGroup'] = '';
        $data['menu'] = 'Auth';

        return view('Auth/Index', $data);
    }

    public function login()
    {
        $vars = $this->request->getVar();

        if (!$this->validateData($vars, [
            'email_user' => [
                'rules' => 'trim|required|valid_email',
                'errors' => [
                    'required' => 'Email wajib diisi.',
                    'valid_email' => 'Harus berupa email valid',
                ]
            ],
            'password_user' => [
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Password wajib diisi',
                ]
            ]
        ])) {
            session()->setFlashdata('failed', 'Harap lengkapi form');
            return redirect()->to('/login')->withInput();
        }

        $user = $this->userModel->where('email_user', $vars['email_user'])->first();

        if (!$user) {
            session()->setFlashdata('failed', 'Email tidak terdaftar');
            return redirect()->to('/login')->withInput();
        } else {
            if (!password_verify($vars['password_user'], $user['password_user'])) {
                session()->setFlashdata('failed', 'Password salah');
                return redirect()->to('/login')->withInput();
            } else {
                session()->set('logged_in', true);
                session()->set('id_user', $user['id_user']);
                session()->set('email_user', $user['email_user']);
                session()->set('name_user', $user['name_user']);
                session()->set('phone_user', $user['phone_user']);
                session()->set('level_user', $user['level_user']);

                session()->setFlashdata('success', 'Login berhasil, selamat datang ' . $user['name_user']);
                return redirect()->to('/');
            }
        }
    }

    public function logout()
    {
        session()->remove('logged_in');
        session()->remove('id_user');
        session()->remove('email_user');
        session()->remove('name_user');
        session()->remove('phone_user');
        session()->remove('level_user');

        session()->setFlashdata('success', 'Anda telah logout, sampai jumpa lagi');
        return redirect()->to('/');
    }
}
