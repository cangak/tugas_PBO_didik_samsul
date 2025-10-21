<?php
class ErrorController extends Controller {
    public function notFound() {
        http_response_code(404);
        echo "<h1>404 - Halaman tidak ditemukan</h1>";
    }
}
