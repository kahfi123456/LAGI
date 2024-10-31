<?php
namespace App\Models;

use CodeIgniter\Model;

class UploadedFileModel extends Model
{
    protected $table = 'uploaded_files'; // Nama tabel
    protected $primaryKey = 'id'; // Primary key
    protected $allowedFields = ['file_name', 'file_type', 'file_path', 'uploaded_at']; // Field yang diizinkan

    public function getAllUploadedFiles()
    {
        return $this->orderBy('id', 'ASC')->findAll(); // Mengambil data dan mengurutkan berdasarkan ID
    }

    public function addFile($data)
    {
        return $this->insert($data); // Menyimpan data file ke database
    }

    public function dashboard()
    {
        $uploadedFiles = $this->getAllUploadedFiles(); // Mengambil semua file yang diupload
        return view('admin/dashboard', ['uploadedFiles' => $uploadedFiles]); // Mengirim data ke view
    }
}