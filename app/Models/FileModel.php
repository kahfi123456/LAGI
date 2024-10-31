<?php
namespace App\Models;

use CodeIgniter\Model;

class FileModel extends Model
{
    // Konfigurasi untuk tabel uploaded_files
    protected $table = 'uploaded_files';
    protected $primaryKey = 'id';
    protected $allowedFields = ['file_name', 'file_type', 'file_path', 'uploaded_at'];

    // Mengambil semua file dari tabel uploaded_files
    public function getAllFiles()
    {
        return $this->findAll();
    }

    // Menyimpan data file ke tabel uploaded_files
    public function addFile(array $data)
    {
        return $this->insert($data);
    }

    // Metode khusus untuk pencarian di tabel files
  
public function searchFiles($keyword)
{
    return $this->builder('files') // Pastikan nama tabel sesuai
        ->groupStart() // Memulai grup untuk kondisi OR
            ->like('filename', $keyword)
            ->orLike('file_path', $keyword)
            ->orLike('faculty', $keyword)
        ->groupEnd() // Mengakhiri grup
        ->get()
        ->getResultArray();
}


}