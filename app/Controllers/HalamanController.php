<?php

class HalamanController extends Controller
{ 

    
    public function index()
    { //method index
        $halamanModel = $this->model('Halaman'); //membuat objek model Halaman
        $data['title'] = 'Daftar Halaman'; //judul halaman
        $data['halaman'] = $halamanModel->getAll(); //mengambil data semua halaman di databases
        $this->view('halaman/index', $data, true); //kirim data ke view
    }



    public function tambah()
    {
        $data['title'] = 'Tambah Halaman';
        $this->view('halaman/tambah', $data, true);
    }
    public function store()
    {
        require_once __DIR__ . '/../Helpers/Flasher.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $judul = trim($_POST['judul_halaman'] ?? '');
            $konten = trim($_POST['konten_halaman'] ?? '');

            if ($judul === '' || $konten === '') {
                Flasher::setFlash('error', 'Gagal', 'Judul dan Konten tidak boleh kosong!');
                header('Location: ' . BASEURL . '/halaman/tambah');
                exit;
            }

            $halamanModel = $this->model('Halaman');
            $gambar = null;

            // --- Validasi upload gambar ---
            if (!empty($_FILES['gambar']['name'])) {
                $fileTmp = $_FILES['gambar']['tmp_name'];
                $fileName = basename($_FILES['gambar']['name']);
                $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                // Pastikan folder uploads ada
                $uploadDir = __DIR__ . '/../../public/uploads/'; // sesuaikan jika berbeda
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                // Batasi ekstensi
                $allowedExt = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

                if (!in_array($fileExt, $allowedExt)) {
                    Flasher::setFlash('error', 'Gagal', 'File harus berupa gambar (jpg, png, gif, webp)!');
                    header('Location: ' . BASEURL . '/halaman/tambah');
                    exit;
                }

                // Cek mime type asli file (lebih aman)
                $mime = mime_content_type($fileTmp);
                if (strpos($mime, 'image/') !== 0) {
                    Flasher::setFlash('error', 'Gagal', 'File bukan gambar yang valid!');
                    header('Location: ' . BASEURL . '/halaman/tambah');
                    exit;
                }

                // Rename file agar unik (hindari overwrite)
                $newFileName = uniqid('img_') . '.' . $fileExt;
                $target = $uploadDir . $newFileName;

                if (move_uploaded_file($fileTmp, $target)) {
                    $gambar = $newFileName;
                } else {
                    Flasher::setFlash('error', 'Gagal', 'Gagal mengunggah gambar!');
                    header('Location: ' . BASEURL . '/halaman/tambah');
                    exit;
                }
            }

            // --- Simpan ke DB ---
            $data = [
                'judul_halaman' => $judul,
                'konten_halaman' => $konten,
                'gambar' => $gambar,
                'user_id' => $_SESSION['id'] ?? 1
            ];

            $halamanModel->tambah($data);

            Flasher::setFlash('success', 'Berhasil', 'Halaman berhasil ditambahkan!');
            header('Location: ' . BASEURL . '/halaman');
            exit;
        }
    }

    public function edit($id)
    {
        $halamanModel = $this->model('Halaman');
    

        $data['title'] = 'Edit Halaman';
        $data['halaman'] = $halamanModel->getById($id);

            $currentRole = strtolower(AuthHelper::role() ?? '');
        $currentUserId = AuthHelper::userId();

    // Hanya admin atau owner yang boleh hapus
    if ($currentRole !== 'admin' && $data['halaman']['user_id'] != $currentUserId) {
        Flasher::setFlash('error', 'Akses Ditolak', 'Anda tidak memiliki izin untuk edit data ini!');
        header('Location: ' . BASEURL . '/halaman');
        exit;
    }

        $this->view('halaman/edit', $data, true);
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $judul = trim($_POST['judul_halaman'] ?? '');
            $konten = trim($_POST['konten_halaman'] ?? '');

            if ($judul === '' || $konten === '') {
                Flasher::setFlash('error', 'Gagal', 'Judul dan Konten tidak boleh kosong!');
                header('Location: ' . BASEURL . '/halaman/edit/' . $id);
                exit;
            }

            $halamanModel = $this->model('Halaman');
            $halaman = $halamanModel->getById($id);

            // Simpan gambar lama sebagai default
            $gambar = $halaman['gambar'] ?? null;

            // --- Jika user upload gambar baru ---
            if (!empty($_FILES['gambar']['name'])) {
                $fileTmp  = $_FILES['gambar']['tmp_name'];
                $fileName = basename($_FILES['gambar']['name']);
                $fileExt  = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                // Pastikan folder uploads ada
                $uploadDir = __DIR__ . '/../../public/uploads/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                // Batasi ekstensi
                $allowedExt = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                if (!in_array($fileExt, $allowedExt)) {
                    Flasher::setFlash('error', 'Gagal', 'File harus berupa gambar (jpg, jpeg, png, gif, webp)!');
                    header('Location: ' . BASEURL . '/halaman/edit/' . $id);
                    exit;
                }

                // Validasi mime type
                $mime = mime_content_type($fileTmp);
                if (strpos($mime, 'image/') !== 0) {
                    Flasher::setFlash('error', 'Gagal', 'File bukan gambar valid!');
                    header('Location: ' . BASEURL . '/halaman/edit/' . $id);
                    exit;
                }

                // Validasi getimagesize (mengecek benar-benar file gambar)
                if (!getimagesize($fileTmp)) {
                    Flasher::setFlash('error', 'Gagal', 'File gambar rusak atau tidak valid!');
                    header('Location: ' . BASEURL . '/halaman/edit/' . $id);
                    exit;
                }

                // Rename agar unik (hindari overwrite)
                $newFileName = uniqid('img_') . '.' . $fileExt;
                $target = $uploadDir . $newFileName;

                // Pindahkan file
                if (move_uploaded_file($fileTmp, $target)) {
                    // Hapus file lama kalau ada dan berbeda
                    if (!empty($halaman['gambar'])) {
                        $oldPath = $uploadDir . $halaman['gambar'];
                        if (file_exists($oldPath)) {
                            unlink($oldPath);
                        }
                    }

                    $gambar = $newFileName;
                } else {
                    Flasher::setFlash('error', 'Gagal', 'Gagal mengunggah gambar!');
                    header('Location: ' . BASEURL . '/halaman/edit/' . $id);
                    exit;
                }
            }

            // --- Simpan update ke DB ---
            $data = [
                'judul_halaman' => $judul,
                'konten_halaman' => $konten,
                'gambar' => $gambar,
                'user_id' => $_SESSION['id'] ?? 1
            ];

            $halamanModel->update($id, $data);

            Flasher::setFlash('success', 'Berhasil', 'Halaman berhasil diperbarui!');
            header('Location: ' . BASEURL . '/halaman');
            exit;
        }
    }


    public function delete($id)
    {
        $halamanModel = $this->model('Halaman');

        // Ambil data halaman dulu untuk tahu nama file gambarnya
        $halaman = $halamanModel->getById($id);
    
        $currentRole = strtolower(AuthHelper::role() ?? '');
        $currentUserId = AuthHelper::userId();

    // Hanya admin atau owner yang boleh hapus
    if ($currentRole !== 'admin' && $halaman['user_id'] != $currentUserId) {
        Flasher::setFlash('error', 'Akses Ditolak', 'Anda tidak memiliki izin untuk menghapus data ini!');
        header('Location: ' . BASEURL . '/halaman');
        exit;
    }

        if ($halaman) {



            // Jika ada gambar, hapus dari folder uploads
            if (!empty($halaman['gambar'])) {
                $uploadDir = __DIR__ . '/../../public/uploads/';
                $filePath = $uploadDir . $halaman['gambar'];

                if (file_exists($filePath) && is_file($filePath)) {
                    unlink($filePath);
                }
            }

            // Hapus data dari database
            $halamanModel->delete($id);

            Flasher::setFlash('success', 'Berhasil', 'Halaman dan gambar berhasil dihapus!');
        } else {
            Flasher::setFlash('error', 'Gagal', 'Data halaman tidak ditemukan!');
        }

        header('Location: ' . BASEURL . '/halaman');
        exit;
    }
}
