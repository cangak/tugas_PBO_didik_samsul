<?php
class HomeController extends Controller {
    public function index(){
        $halamanModel = $this->model('Halaman');
        $kontakModel = $this->model('Kontak');
        $data['total_halaman'] = $halamanModel->countHalaman();
        $data['total_kontak'] = $kontakModel->countKontak();
        $data['title'] = $kontakModel->countKontak();

        $this->view('home', $data,true);
       
    }
}
