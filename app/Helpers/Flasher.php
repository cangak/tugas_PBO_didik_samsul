<?php
class Flasher {
    public static function setFlash($type, $title, $message) {
        $_SESSION['flash'] = [
            'type' => $type,
            'title' => $title,
            'message' => $message
        ];
    }
    public static function flash() {
        if (isset($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            unset($_SESSION['flash']);
            echo "<script>
                Swal.fire({
                    title: '{$flash['title']}',
                    text: '{$flash['message']}',
                    icon: '{$flash['type']}',
                    showConfirmButton: true,
                    timer: 2000,
                    timerProgressBar: true
                });
            </script>";
        }
    }
}