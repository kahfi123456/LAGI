<?php
namespace App\Controllers;

use App\Models\FileModel;

class FileManagerController extends BaseController
{
    protected $fileModel;
    protected $logger;

    public function __construct()
    {
        $this->fileModel = new FileModel(); // Inisialisasi model
        $this->logger = \Config\Services::logger(); // Inisialisasi logger
    }

    public function index()
    {
        // Mendapatkan data fakultas
        $data['faculties'] = [
            ['name' => 'FE', 'icon' => 'folder-icon.png'],
            ['name' => 'FHISIP', 'icon' => 'folder-icon.png'],
            ['name' => 'FKIP', 'icon' => 'folder-icon.png'],
            ['name' => 'FST', 'icon' => 'folder-icon.png'],
            ['name' => 'PPS', 'icon' => 'folder-icon.png'],
        ];

        $this->logger->info('User accessed file manager index page');

        return view('file_manager/index', $data); // Menampilkan view index
    }

    public function faculty($faculty)
    {
        // Validasi fakultas
        $validFaculties = ['FE', 'FHISIP', 'FKIP', 'FST', 'PPS'];
        if (!in_array($faculty, $validFaculties)) {
            $this->logger->error('Invalid faculty accessed: ' . $faculty);
            return redirect()->to('/filemanager')->with('error', 'Fakultas tidak valid.'); // Redirect jika fakultas tidak valid
        }

        // Mengambil file berdasarkan fakultas dari database
        $data['faculty'] = $faculty;
        $data['files'] = $this->fileModel->where('faculty', $faculty)->findAll();

        // Jika tidak ada file ditemukan
        if (empty($data['files'])) {
            $data['message'] = 'Tidak ada file ditemukan untuk fakultas ' . esc($faculty) . '.';
        }

        return view('file_manager/faculty', $data); // Menampilkan view faculty
    }

  public function search()
{
    // Mendapatkan query pencarian dari URL
    $query = $this->request->getGet('query');

    // Validasi input query
    if (empty($query)) {
        return redirect()->to('/filemanager')->with('error', 'Query pencarian tidak boleh kosong.');
    }

    // Mengambil file berdasarkan query pencarian
    $data['files'] = $this->fileModel->like('filename', $query) // Pastikan kolom ini sesuai
                                      ->orLike('faculty', $query)
                                      ->findAll();

    // Jika tidak ada file ditemukan
    if (empty($data['files'])) {
        $data['message'] = 'Tidak ada file ditemukan untuk pencarian "' . esc($query) . '".';
    }

    // Tambahkan variabel query ke data
    $data['query'] = $query;

    return view('file_manager/search_results', $data);
}


    public function download($id)
    {
        $file = $this->fileModel->find($id);

        if (!$file) {
            return redirect()->to('/filemanager')->with('error', 'File tidak ditemukan.');
        }

        $filePath = FCPATH . $file['file_path']; // Path file di server

        if (!file_exists($filePath)) {
            return redirect()->to('/filemanager')->with('error', 'File tidak ditemukan di server.');
        }

        return $this->response->download($filePath, null)->setFileName($file['file_name']);
    }

    public function addSwitRoutingZip()
    {
        // Daftar fakultas
        $faculties = ['FE', 'FHISIP', 'FKIP', 'FST', 'PPS'];
        $fileName = 'Swit Routing.zip';

        foreach ($faculties as $faculty) {
            $data = [
                'faculty' => $faculty,
                'file_name' => $fileName,
                'file_path' => "uploads/$faculty/$fileName",
                'uploaded_at' => date('Y-m-d H:i:s')
            ];

            // Menyimpan data ke database
            $this->fileModel->insert($data);
        }

        return redirect()->to('/filemanager')->with('message', 'File Swit Routing.zip berhasil ditambahkan ke semua fakultas');
    }

    public function delete($id)
    {
        if ($this->fileModel->delete($id)) { // Pastikan file berhasil dihapus
            return redirect()->to('/filemanager')->with('message', 'File berhasil dihapus!');
        } else {
            return redirect()->to('/filemanager')->with('error', 'Gagal menghapus file.');
        }
    }

    // Menampilkan form upload file
    public function upload()
    {
        return view('file_manager/upload'); // Menampilkan view form upload
    }

    // Proses upload file
    public function uploadFile()
    {
        // Validasi file
        $file = $this->request->getFile('uploaded_file');
        if (!$file->isValid()) {
            return redirect()->back()->with('error', 'File tidak valid.');
        }

        // Validasi fakultas
        $faculty = $this->request->getPost('faculty');
        if (!in_array($faculty, ['FE', 'FHISIP', 'FKIP', 'FST', 'PPS'])) {
            return redirect()->back()->with('error', 'Fakultas tidak valid.');
        }

        // Simpan file dan data ke database
        $newFileName = $file->getRandomName();
        $file->move("uploads/$faculty", $newFileName);

        $data = [
            'faculty' => $faculty,
            'file_name' => $newFileName,
            'file_path' => "uploads/$faculty/$newFileName",
            'uploaded_at' => date('Y-m-d H:i:s') // Pastikan penamaan kolom ini sesuai dengan database
        ];

        $this->fileModel->insert($data);

        return redirect()->to('/filemanager')->with('message', 'File berhasil diupload.');
    }
}