<?php
class LoginController extends Controller
{
        private $db;

     public function __construct()
    {
        $this->db = new Database();
    }
    public function index()
    {
        $this->view('login/index', ['title' => 'Login'], false);
    }
    public function proses()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = htmlspecialchars($_POST['username'] ?? '');
            $password = htmlspecialchars($_POST['password'] ?? '');
            $loginModel = $this->model('Login');
            $data = $loginModel->getUserByUsername($username);

            if ($data && password_verify($password, $data['password'])) {
                $_SESSION['user'] = $data['username'];
                $_SESSION['id'] = $data['id'];
                $_SESSION['nama'] = $data['nama'];
                require_once __DIR__ . '/../Helpers/Flasher.php';
                Flasher::setFlash('success', 'Berhasil', 'Berhasil Login!');
                header('Location: ' . BASEURL . '/home');
                exit;
            } else {
                require_once __DIR__ . '/../Helpers/Flasher.php';
                Flasher::setFlash('error', 'Gagal', 'username / password yang anda masukkan salah!');
                header('Location: ' . BASEURL . '/login');
                exit;
            }
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
