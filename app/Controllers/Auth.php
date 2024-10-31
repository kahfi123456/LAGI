<?php

namespace App\Controllers;

use App\Models\AdminModel; // Pastikan untuk mengganti dengan model admin yang sesuai
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function login()
    {
        // Menampilkan view login
        return view('admin/login'); // Pastikan ada file view login di app/Views
    }

    public function loginSubmit()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $adminModel = new AdminModel(); // Ganti dengan nama model yang sesuai
        $admin = $adminModel->where('username', $username)->first();

        if ($admin && password_verify($password, $admin['password'])) {
            // Simpan session atau apa pun yang diperlukan
            session()->set('isLoggedIn', true);
            session()->set('username', $admin['username']);

            return redirect()->to('/dashboard'); // Ubah sesuai dengan rute dashboard kamu
        } else {
            // Gagal login
            return redirect()->back()->with('error', 'Username atau password salah');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login'); // Ubah sesuai dengan rute login kamu
    }
}