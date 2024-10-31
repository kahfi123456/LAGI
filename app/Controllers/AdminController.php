<?php
namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\FileModel; 
use CodeIgniter\Controller;

class AdminController extends Controller
{
    protected $fileModel; // Deklarasi untuk model

    public function __construct()
    {
        $this->fileModel = new FileModel(); // Inisialisasi model FileModel
    }

    public function login()
    {
        return view('admin/login'); // Menampilkan form login
    }

    public function authenticate()
    {
        $adminModel = new AdminModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $admin = $adminModel->getAdminByUsername($username);

        if ($admin && password_verify($password, $admin['password'])) {
            session()->set(['isLoggedIn' => true, 'username' => $username]);
            return redirect()->to('/admin/dashboard'); // Mengarahkan ke halaman dashboard
        }

        return redirect()->back()->with('error', 'Username atau password salah');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/admin/login');
    }

    public function uploadForm()
    {
        return view('admin/upload'); // Pastikan view ini ada
    }

    public function dashboard()
    {
        $uploadedFiles = $this->fileModel->findAll(); // Mengambil semua file yang diupload

        return view('admin/dashboard', ['uploadedFiles' => $uploadedFiles]); // Mengirim data ke view
    }

    public function uploadFile()
    {
        // Ambil file dari form
        $file = $this->request->getFile('file'); // "file" adalah nama input file di form

        if ($file->isValid() && !$file->hasMoved()) {
            // Pindahkan file ke folder 'uploads'
            $file->move(WRITEPATH . 'uploads'); // Gunakan WRITEPATH untuk keamanan

            // Simpan informasi file ke database
            $this->fileModel->save([
                'file_name' => $file->getName(),
                'file_type' => $file->getClientMimeType(),
                'file_path' => 'uploads/' . $file->getName(),
                'uploaded_at' => date('Y-m-d H:i:s'), // Pastikan ini sesuai dengan tabel
            ]);

            return redirect()->to('/admin/dashboard')->with('message', 'File berhasil diunggah!'); // Arahkan kembali ke dashboard
        }

        return redirect()->back()->with('error', 'Gagal mengunggah file.');
    }

    public function insertFacultyFiles()
    {
        // Data untuk masing-masing fakultas
        $facultyFiles = [
            ['file_name' => '0069.zip', 'file_type' => 'application/zip', 'file_path' => 'uploads/FE/0069.zip', 'uploaded_at' => date('Y-m-d H:i:s')],
            ['file_name' => '0069.zip', 'file_type' => 'application/zip', 'file_path' => 'uploads/FHISIP/0069.zip', 'uploaded_at' => date('Y-m-d H:i:s')],
            ['file_name' => '0069.zip', 'file_type' => 'application/zip', 'file_path' => 'uploads/FKIP/0069.zip', 'uploaded_at' => date('Y-m-d H:i:s')],
            ['file_name' => '0069.zip', 'file_type' => 'application/zip', 'file_path' => 'uploads/FST/0069.zip', 'uploaded_at' => date('Y-m-d H:i:s')],
            ['file_name' => '0069.zip', 'file_type' => 'application/zip', 'file_path' => 'uploads/PPS/0069.zip', 'uploaded_at' => date('Y-m-d H:i:s')],
        ];

        // Menyisipkan data ke dalam database
        foreach ($facultyFiles as $file) {
            $this->fileModel->insert($file);
        }

        return redirect()->to('/admin/dashboard')->with('message', 'Data fakultas berhasil ditambahkan!');
    }

    public function deleteFile($id)
    {
        // Cek apakah file ada
        $file = $this->fileModel->find($id);
        
        if ($file) {
            // Menghapus file dari database
            $this->fileModel->delete($id);

            // Jika perlu, hapus file fisik dari server
            if (file_exists(WRITEPATH . $file['file_path'])) {
                unlink(WRITEPATH . $file['file_path']);
            }

            return redirect()->to('/admin/dashboard')->with('message', 'File berhasil dihapus!');
        }

        return redirect()->to('/admin/dashboard')->with('error', 'File tidak ditemukan.');
    }
}