<?php
class LoginController extends Controller
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }
    public function register()
    {
        $this->view('login/register', ['title' => 'Register'], false);
    }
    public function index()
    {
        $this->view('login/index', ['title' => 'Login'], false);
    }
    public function registerproses()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = htmlspecialchars($_POST['nama'] ?? '');
            $username = htmlspecialchars($_POST['username'] ?? '');
            $password = htmlspecialchars($_POST['password'] ?? '');

            $hashPassword = password_hash($password, PASSWORD_DEFAULT);

            $loginModel = $this->model('Login');
            $register = $loginModel->registerUser($nama, $username, $hashPassword);

            require_once __DIR__ . '/../Helpers/Flasher.php';

            if ($register) {
                Flasher::setFlash('success', 'Berhasil', 'Berhasil Register!');
                header('Location: ' . BASEURL . '/login');
                exit;
            } else {
                Flasher::setFlash('error', 'Gagal', 'Gagal Register!');
                header('Location: ' . BASEURL . '/login/register');
                exit;
            }
        }
    }
    public function proses()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = htmlspecialchars($_POST['username'] ?? '');
            $password = htmlspecialchars($_POST['password'] ?? '');

            $loginModel = $this->model('Login');
            $data = $loginModel->getUserByUsername($username);

            require_once __DIR__ . '/../Helpers/Flasher.php';

            // Jika user tidak ditemukan
            if (!$data) {
                Flasher::setFlash('error', 'Gagal', 'Username tidak ditemukan!');
                header('Location: ' . BASEURL . '/login');
                exit;
            }

            // Cek password
            if (!password_verify($password, $data['password'])) {
                Flasher::setFlash('error', 'Gagal', 'Username atau password salah!');
                header('Location: ' . BASEURL . '/login');
                exit;
            }

            // Cek apakah user punya role
            if (empty($data['role_id']) || empty($data['role_nama'])) {
                Flasher::setFlash('error', 'Gagal', 'Akun belum memiliki role. Hubungi administrator!');
                header('Location: ' . BASEURL . '/login');
                exit;
            }

            // Simpan session
            $_SESSION['user'] = $data['username'];
            $_SESSION['id'] = $data['id'];
            $_SESSION['nama'] = $data['nama'];
            $_SESSION['role_id'] = $data['role_id'];
            $_SESSION['role_nama'] = $data['role_nama'];

            Flasher::setFlash('success', 'Berhasil', 'Berhasil login!');
            header('Location: ' . BASEURL . '/home');
            exit;
        }
    }



    public function logout()
    {
        unset($_SESSION['user']);
        session_destroy();

        header('Location: ' . BASEURL . '/login');
        exit;
    }
}
