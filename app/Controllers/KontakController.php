<?php
class KontakController extends Controller {
    public function index() {
        $kontakModel = $this->model('Kontak');
        $data['title'] = 'Kontak';
        $data['kontak'] = $kontakModel->getAllKontak();
        $this->view('kontak/index', $data, true);
    }

    public function edit($id) {
        $kontakModel = $this->model('Kontak');
        $data['title'] = 'Edit Kontak';
        $data['kontak'] = $kontakModel->getKontakById($id);
        $this->view('kontak/edit', $data, true);
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $kontakModel = $this->model('Kontak');
            $data = [
                'nama' => $_POST['nama'],
                'nomor_hp' => $_POST['nomor_hp'],
                'status' => $_POST['status']
            ];
            $kontakModel->updateKontak($id, $data);
            header('Location: ' . BASEURL . '/kontak');
            exit;
        }
    }

    public function delete($id) {
        $kontakModel = $this->model('Kontak');
        $kontakModel->deleteKontak($id);
        header('Location: ' . BASEURL . '/kontak');
        exit;
    }

    public function tambah() {
        $data['title'] = 'Tambah Kontak';
        $this->view('kontak/tambah', $data, true);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $kontakModel = $this->model('Kontak');
            $data = [
                'nama' => $_POST['nama'],
                'nomor_hp' => $_POST['nomor_hp'],
                'status' => $_POST['status'],
                'user_id' => $_SESSION['id'] ?? 1 // default 1 jika belum login
            ];
            $kontakModel->tambahKontak($data);
            header('Location: ' . BASEURL . '/kontak');
            exit;
        }
    }
}