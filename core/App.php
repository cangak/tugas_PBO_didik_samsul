<?php
// =====================================================
// Class utama untuk routing dan kontrol aplikasi
// =====================================================
class App
{
    // Property default controller, method, dan parameter
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];

    // =====================================================
    // Konstruktor: Proses utama routing & auth check
    // =====================================================
    public function __construct()
    {
        $url = $this->parseUrl(); // Parsing URL menjadi array ada di bawah method nya.

        // =====================================================
        // AUTH CHECK: Cek apakah user sudah login
        // =====================================================
        if (!isset($_SESSION['user'])) {
            // Jika URL mengarah ke login, izinkan akses LoginController
            if (isset($url[0]) && strtolower($url[0]) === 'login') {
                $this->controller = 'LoginController';
                unset($url[0]);
                require_once __DIR__ . '/../app/Controllers/' . $this->controller . '.php';
                $this->controller = new $this->controller;

                // Jika ada method di URL, gunakan method tersebut
                if (isset($url[1]) && method_exists($this->controller, $url[1])) {
                    $this->method = $url[1];
                    unset($url[1]);
                }

                // Sisanya sebagai parameter
                $this->params = $url ? array_values($url) : [];
                // Eksekusi controller dan method
                call_user_func_array([$this->controller, $this->method], $this->params);
                return;
            }

            // Jika bukan login, redirect ke halaman login
            header('Location: ' . BASEURL . '/login');
            exit;
        }

        // =====================================================
        // ROUTING NORMAL: Routing ke controller & method sesuai URL
        // =====================================================
        // Jika controller sesuai file ada, gunakan controller tsb
        if (isset($url[0]) && file_exists(__DIR__ . '/../app/Controllers/' . ucfirst($url[0]) . 'Controller.php')) {
            $this->controller = ucfirst($url[0]) . 'Controller';
            unset($url[0]);
        } elseif (!empty($url[0])) {
            // Jika controller atau file tidak ditemukan, arahkan ke ErrorController.
            $this->controller = 'ErrorController';
            $this->method = 'notFound';
            $url = [];
        }

        // Load controller
        require_once __DIR__ . '/../app/Controllers/' . $this->controller . '.php';
        // inisiasi controller dengan nama class sesuai dengan require di ats.
        $this->controller = new $this->controller;

        // Jika ada method di URL, gunakan method tersebut
        // tugas.com/Controller/method
        // $url[0] = Controller
        // $url[1] = method
        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }

        // tugas.com/Controller/method/param1/param2/paramx
        // $url[0] = Controller
        // $url[1] = method
        // $url[2] = param1
        // $url[3] = param2
        // $url[x] = paramx
        // belum coba yang param 2 3 dan seterusnya

        $this->params = $url ? array_values($url) : [];
        // Eksekusi controller dan method
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    // =====================================================
    // Method private untuk parsing URL menjadi array
    // =====================================================
    private function parseUrl()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = trim($uri, '/');
        return $uri ? explode('/', $uri) : [];
        
    }
}
