<?php
namespace App\Models;

use CodeIgniter\Model;

class FileFacultyModel extends Model
{
    // Konfigurasi untuk tabel files
    protected $table = 'files';
    protected $primaryKey = 'id';
    protected $allowedFields = ['faculty', 'filename', 'file_path', 'created_at'];

    // Mengambil file berdasarkan fakultas
    public function getFilesByFaculty($faculty_name)
    {
        return $this->where('faculty', $faculty_name)->findAll(); // Mengambil semua file untuk fakultas tertentu
    }
}