<?php

class UserController extends Controller
{
    public function index()
    {
        $userModel = $this->model('User');
        $data['title'] = 'Manajemen User';
        $data['users'] = $userModel->getAll();

        $this->view('user/index', $data, true);
    }

    public function tambah()
    {
        $data['title'] = 'Tambah User';
        $this->view('user/tambah', $data, true);
    }

    public function store()
    {
        require_once __DIR__ . '/../Helpers/Flasher.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = trim($_POST['nama'] ?? '');
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if ($nama === '' || $username === '' || $password === '') {
                Flasher::setFlash('error', 'Gagal', 'Nama, Username, dan Password wajib diisi!');
                header('Location: ' . BASEURL . '/user/tambah');
                exit;
            }

            // Validasi panjang password
            if (strlen($password) < 6) {
                Flasher::setFlash('error', 'Gagal', 'Password minimal 6 karakter!');
                header('Location: ' . BASEURL . '/user/tambah');
                exit;
            }

            // Cek username sudah dipakai?
            $userModel = $this->model('User');
            $existing = $userModel->getByUsername($username);
            if ($existing) {
                Flasher::setFlash('error', 'Gagal', 'Username sudah digunakan!');
                header('Location: ' . BASEURL . '/user/tambah');
                exit;
            }

            $data = [
                'nama' => $nama,
                'username' => $username,
                'password' => $password
            ];

            $userModel->tambah($data);
            Flasher::setFlash('success', 'Berhasil', 'User baru berhasil ditambahkan!');
            header('Location: ' . BASEURL . '/user');
            exit;
        }
    }

    public function edit($id)
    {
        $userModel = $this->model('User');
        $data['title'] = 'Edit User';
        $data['user'] = $userModel->getById($id);

        if (!$data['user']) {
            Flasher::setFlash('error', 'Gagal', 'Data user tidak ditemukan!');
            header('Location: ' . BASEURL . '/user');
            exit;
        }

        $this->view('user/edit', $data, true);
    }

    public function update($id)
    {
        require_once __DIR__ . '/../Helpers/Flasher.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = trim($_POST['nama'] ?? '');
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if ($nama === '' || $username === '') {
                Flasher::setFlash('error', 'Gagal', 'Nama dan Username wajib diisi!');
                header('Location: ' . BASEURL . '/user/edit/' . $id);
                exit;
            }

            $userModel = $this->model('User');
            $existing = $userModel->getByUsername($username);

            // Cegah duplikasi username (selain dirinya sendiri)
            if ($existing && $existing['id'] != $id) {
                Flasher::setFlash('error', 'Gagal', 'Username sudah digunakan oleh user lain!');
                header('Location: ' . BASEURL . '/user/edit/' . $id);
                exit;
            }

            $data = [
                'nama' => $nama,
                'username' => $username,
                'password' => $password // kosongkan jika tidak ingin ubah
            ];

            $userModel->update($id, $data);
            Flasher::setFlash('success', 'Berhasil', 'Data user berhasil diperbarui!');
            header('Location: ' . BASEURL . '/user');
            exit;
        }
    }

    public function delete($id)
    {
        $userModel = $this->model('User');
        $user = $userModel->getById($id);

        if (!$user) {
            Flasher::setFlash('error', 'Gagal', 'User tidak ditemukan!');
            header('Location: ' . BASEURL . '/user');
            exit;
        }

        $userModel->delete($id);
        Flasher::setFlash('success', 'Berhasil', 'User berhasil dihapus!');
        header('Location: ' . BASEURL . '/user');
        exit;
    }
}
