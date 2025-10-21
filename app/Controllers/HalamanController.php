<?php

class HalamanController extends Controller { //class HalamanController
    public function index() { //method index
        $halamanModel = $this->model('Halaman'); //membuat objek model Halaman
        $data['title'] = 'Daftar Halaman'; //judul halaman
        $data['halaman'] = $halamanModel->getAll(); //mengambil data semua halaman di databases
        $this->view('halaman/index', $data, true); //kirim data ke view
    }
    
  

    public function tambah() {
        $data['title'] = 'Tambah Halaman';
        $this->view('halaman/tambah', $data, true);
    }

    public function store() {
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
            if (!empty($_FILES['gambar']['name'])) {
                $target = 'uploads/' . basename($_FILES['gambar']['name']);
                move_uploaded_file($_FILES['gambar']['tmp_name'], $target);
                $gambar = $_FILES['gambar']['name'];
            }
            $data = [
                'judul_halaman' => $_POST['judul_halaman'],
                'konten_halaman' => $_POST['konten_halaman'],
                'gambar' => $gambar,
                'user_id' => $_SESSION['id'] ?? 1
            ];
            $halamanModel->tambah($data);
            header('Location: ' . BASEURL . '/halaman');
            exit;
        }
    }

    public function edit($id) {
        $halamanModel = $this->model('Halaman');
        $data['title'] = 'Edit Halaman';
        $data['halaman'] = $halamanModel->getById($id);
        $this->view('halaman/edit', $data, true);
    }

    public function update($id) {
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
            $gambar = $halaman['gambar'];
            if (!empty($_FILES['gambar']['name'])) {
                $target = 'uploads/' . basename($_FILES['gambar']['name']);
                move_uploaded_file($_FILES['gambar']['tmp_name'], $target);
                $gambar = $_FILES['gambar']['name'];
            }
            $data = [
                'judul_halaman' => $_POST['judul_halaman'],
                'konten_halaman' => $_POST['konten_halaman'],
                'gambar' => $gambar,
                'user_id' => $_SESSION['id'] ?? 1
            ];
            $halamanModel->update($id, $data);
            header('Location: ' . BASEURL . '/halaman');
            exit;
        }
    }

    public function delete($id) {
        $halamanModel = $this->model('Halaman');
        $halamanModel->delete($id);
        header('Location: ' . BASEURL . '/halaman');
        exit;
    }
}