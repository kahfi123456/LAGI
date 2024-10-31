<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'admin'; // Nama tabel
    protected $primaryKey = 'id'; // Primary key
    protected $allowedFields = ['username', 'password']; // Field yang diizinkan

    public function getAdminByUsername($username)
    {
        return $this->where('username', $username)->first(); // Mengambil admin berdasarkan username
    }
    // Metode untuk mendapatkan file yang diunggah
    public function getUploadedFiles()
    {
        return $this->db->table('uploaded_files')->get()->getResultArray(); // Ambil semua file
        $uploadedFilesModel = new UploadedFileModel();
$uploadedFiles = $uploadedFilesModel->getAllUploadedFiles();
return view('admin/dashboard', ['uploadedFiles' => $uploadedFiles]);

    }
}