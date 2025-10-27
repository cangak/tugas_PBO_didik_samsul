<?php
class KontakController extends Controller
{

    private $currentRole;
    private $currentUserId;
    private $isAdmin;

    public function __construct()
    {
        $this->currentRole = strtolower(AuthHelper::role() ?? '');
        $this->currentUserId = AuthHelper::userId();
        $this->isAdmin = ($this->currentRole === 'admin');

        // proteksi agar hanya user login yang boleh akses controller ini:
        if (!AuthHelper::check()) {
            header('Location: ' . BASEURL . '/login');
            exit;
        }
    }



    public function index()
    {
        $kontakModel = $this->model('Kontak');
        $data['title'] = 'Kontak';
        $data['kontak'] = $kontakModel->getAllKontak();
        $this->view('kontak/index', $data, true);
    }

    public function edit($id)
    {
        $kontakModel = $this->model('Kontak');
        $data['title'] = 'Edit Kontak';
        $data['kontak'] = $kontakModel->getKontakById($id);
        if (!$this->isAdmin &&  $data['kontak']['user_id'] != $this->currentUserId) {
            require_once __DIR__ . '/../Helpers/Flasher.php';
            Flasher::setFlash('error', 'Akses Ditolak', 'Anda tidak memiliki izin!');
            header('Location: ' . BASEURL . '/kontak');
            exit;
        }
        $this->view('kontak/edit', $data, true);
    }

    public function update($id)
    {
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

    public function delete($id)
    {
        $kontakModel = $this->model('Kontak');
        $kontak = $kontakModel->getKontakById($id);
 if (!$this->isAdmin &&  $kontak['user_id'] != $this->currentUserId) {
            require_once __DIR__ . '/../Helpers/Flasher.php';
            Flasher::setFlash('error', 'Akses Ditolak', 'Anda tidak memiliki izin!');
            header('Location: ' . BASEURL . '/kontak');
            exit;
        }
        $kontakModel->deleteKontak($id);


        header('Location: ' . BASEURL . '/kontak');
        exit;
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Kontak';
        $this->view('kontak/tambah', $data, true);
    }

    public function store()
    {
        require_once __DIR__ . '/../Helpers/Flasher.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = trim($_POST['nama'] ?? '');
            $nomor_hp = trim($_POST['nomor_hp'] ?? '');
            if ($nama === '' || $nomor_hp === '') {
                Flasher::setFlash('error', 'Gagal', 'nama dan Nohp tidak boleh kosong!');
                header('Location: ' . BASEURL . '/kontak/tambah');
                exit;
            }

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
