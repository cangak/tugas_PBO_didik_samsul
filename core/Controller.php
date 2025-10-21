<?php
// Mendefinisikan class induk Controller
class Controller
{
    // Method protected untuk menampilkan view
    protected function view($view, $data = [], $useLayout = true)
    {
        extract($data); // Mengubah array $data menjadi variabel
        if ($useLayout) { // Jika ingin memakai layout

            require __DIR__ . '/../app/Views/layouts/html.php';      // Memuat file layout HTML utama
            require __DIR__ . '/../app/Views/layouts/sidebar.php';   // Memuat sidebar
            echo '<div id="main" class="layout-navbar navbar-fixed">'; // Membuka div utama

            require __DIR__ . '/../app/Views/layouts/header.php';    // Memuat header/topbar
            echo '<div id="main-content">';                          // Membuka div konten utama
            
            require __DIR__ . '/../app/Views/' . $view . '.php';     // Memuat file view sesuai parameter
            echo '</div>';                                           // Menutup div konten utama
            require __DIR__ . '/../app/Views/layouts/footer.php';    // Memuat footer
            echo '</div>';                                           // Menutup div utama

        } else { // Jika tidak memakai layout
            require __DIR__ . '/../app/Views/' . $view . '.php';     // Hanya memuat file view saja
        }
    }

    // Method protected untuk memanggil model
    protected function model($model)
    {
        require_once __DIR__ . '/../app/Models/' . $model . '.php'; // Memuat file model
        return new $model; // Mengembalikan objek model
    }
}
