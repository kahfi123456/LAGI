<?php
namespace App\Models;

use CodeIgniter\Model;

class FileModel extends Model
{
    
    protected $table = 'uploaded_files'; // Nama tabel yang tepat
    protected $primaryKey = 'id'; // Primary key tabel
    protected $allowedFields = ['file_name', 'file_type', 'file_path', 'uploaded_at']; // Pastikan kolom-kolom ini ada di tabel

    public function getAllFiles()
    {
        return $this->findAll(); // Mengambil semua file dari tabel uploaded_files
    }

    public function addFile(array $data) // Tambahkan tipe data array
    {
        return $this->insert($data); // Menyimpan data file ke tabel uploaded_files
    }

    public function searchFiles(string $query) // Tambahkan tipe data string
    {
        return $this->like('file_name', $query) // Mencari file berdasarkan file_name
                    ->orLike('faculty', $query) // Uncomment jika kolom faculty ada di tabel
                    ->findAll(); // Mengembalikan hasil pencarian
    }
}