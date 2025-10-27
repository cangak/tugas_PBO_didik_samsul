<?php

class MenuController extends Controller
{
    public function index() {
        $menuModel = $this->model('Menu');
        $data['menus'] = $menuModel->getAll();
        $this->view('menu/index', $data);
    }

    public function tambah() {
        $menuModel = $this->model('Menu');
        $data['parents'] = $menuModel->getParentOptions();
        $this->view('menu/tambah', $data);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $menuModel = $this->model('Menu');
            $menuModel->tambah($_POST);
            header('Location: ' . BASEURL . '/menu');
            exit;
        }
    }

    public function edit($id) {
        $menuModel = $this->model('Menu');
        $data['menu'] = $menuModel->getById($id);
        $data['parents'] = $menuModel->getParentOptions();
        $this->view('menu/edit', $data);
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $menuModel = $this->model('Menu');
            $menuModel->update($id, $_POST);
            header('Location: ' . BASEURL . '/menu');
            exit;
        }
    }

    public function delete($id) {
        $menuModel = $this->model('Menu');
        $menuModel->delete($id);
        header('Location: ' . BASEURL . '/menu');
        exit;
    }
}
